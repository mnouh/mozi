###image recognition integration with balanced mozi payments
#flow:
#registration of user w/ mozi includes photo for database comparison
#user initaties transaction for POS-determined amount
#system compares photo and lists and confirms name of user (or sends message via text)
#when confirmed, system initates transaction
#
#need two components: 1. image registration, segmentation of photo
#2. payment component

from pyfaces import pyfaces
import cv, cv2, Image
import math
import MySQLdb as mdb

import balanced
key_secret = '5340a9843f6b11e28447026ba7cd33d0'
balanced.configure(key_secret)


class faceRecognition:
    def __init__(self, testImg, imgDatabase):
        print "beginning facial recognition"
        #tunable parameters
        self.egfaces=4
        self.thrshld=2
        #operation
        self.test=testImg
        self.database=imgDatabase
        

    def analyze(self):
        pyf=pyfaces.PyFaces(self.test, self.database, self.egfaces, self.thrshld)
        out=pyf.getFileLocation()
        return out

    def newImageQuery(self, testImg):
        self.test=testImg
        return

class faceDetect:
    def __init__(self, imagePath):
        self.path=imagePath

    def analyze(self, outLocation):
        storage=cv.CreateMemStorage()
        HAAR_CASCADE_PATH="C:\\mozi\\backend\\pyfaces\\haarcascade_frontalface_default.xml"
        cascade=cv.Load(HAAR_CASCADE_PATH)

        #convert to grayscale
        image=cv2.imread(self.path)
        image=cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
        cv2.imwrite(self.path,image)
    
        #image=cv.LoadImage(self.path,cv.CV_LOAD_IMAGE_GRAYSCALE)
        image=cv.LoadImage(self.path)
        
        detected = cv.HaarDetectObjects(image, cascade, storage, 1.2, 3, cv.CV_HAAR_DO_CANNY_PRUNING, (100,100))
        print detected
        faceDetect=False

        if detected:
            
            for face in detected:
                midpoint=(int(face[0][0]+(.5*face[0][2])),int(face[0][1]+(.5*face[0][3])))

                x_base, y_base = midpoint[0]-int((.5*230)), midpoint[1]-int((.5*316))
                x_new, y_new = x_base+230, y_base+316
                
                #cv.Rectangle(image,(face[0][0],face[0][1]),(face[0][0]+face[0][2],face[0][1]+face[0][3]), cv.RGB(155, 255, 25),2)
                cv.NamedWindow("w1", cv.CV_WINDOW_AUTOSIZE)
                cv.Rectangle(image,(midpoint[0]-int((.5*230)),midpoint[1]-int((.5*316))), (midpoint[0]-int((.5*230))+230,midpoint[1]-int((.5*316))+316), cv.RGB(155, 255, 25),2)
                cv.ShowImage("w1",image)
                cv.WaitKey(10);

                im = Image.open(self.path)
                cropImg=im.crop((x_base,y_base,x_new,y_new))
                outpath=outLocation
                cropImg.save(outpath, "JPEG")
                faceDetect=True

        else:
            print "No face detected. Please try again."

        return faceDetect


class readDatabase():
    def __init__(self):
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        print "connecting to sql server"

    def checkMember(self, userID): #search by User Twitter Handle [-2] ... User Mozi Name = [3]
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT * FROM tbl_user")
        data=cur.fetchall()
        for row in data:
            self.database.append(row)

        member=False

        for user in range(len(self.database)):
            if userID == self.database[user][22]: #twitter handle
                member=True

        return member

    def getNameAndEmail(self, userID):
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT firstName, lastName, email FROM tbl_user WHERE id=%s",(userID))
        data=cur.fetchall()
        return data[0]
        


class payDatabase:
    def __init__(self):
        return
    
    def linkedBankAccount(self, userID): #moziUserNumber
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT * FROM tbl_bankAccount WHERE userID=%s", (str(userID)))
        data=cur.fetchall()
        for row in data:
            self.database.append(row)
        return self.database

    def linkedCreditCard(self, userID):
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT * FROM tbl_creditCard WHERE userID=%s", (str(userID)))
        data=cur.fetchall()
        for row in data:
            self.database.append(row)
        return self.database

    def newTransaction(self,sendID, receiveID, amount,description, tweetID, tracking): #last value is 0 because transaction is pending
        newtime=time.strftime('%Y-%m-%d %H:%M:%S')
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("INSERT INTO tbl_transaction (recieverId, senderId, amount, description, date, status, paymentType, paymentTypeId, tweetId, paymentTracking) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", (receiveID, sendID, amount, description, newtime, 0, 0, 2147483647, tweetID, 0))

        cur.execute("SELECT * FROM tbl_transaction WHERE date=%s and recieverId=%s", (newtime, receiveID))
        data=cur.fetchall()
        return data

    def searchTweetTransaction(self, tweetID):
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT * FROM tbl_transaction WHERE tweetId=%s", (tweetID))
        data=cur.fetchall()
        return data

    def acceptTweetTransaction(self, tweetID):
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("UPDATE tbl_transaction SET paymentTracking=1 WHERE tweetId=%s", (tweetID))

    def creditReceiver(self, userID, amount):
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT balance FROM tbl_user WHERE id=%s", (userID))
        balance=cur.fetchall()
        balance=balance[0][0]
        balance=balance+amount
        print userID
        print balance
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        res=cur.execute("UPDATE tbl_user SET balance=%s WHERE id=%s", (balance,userID))

            

    def debitSender(self, userID, amount):#
        print userID
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT balance FROM tbl_user WHERE id=%s", (userID))
        balance=cur.fetchall()
        print balance
        balance=balance[0][0]
        balance=balance-amount
        print "sender",userID
        print balance
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("UPDATE tbl_user SET balance=%s WHERE id=%s", (balance,userID))
        
        

#############
print "***Image Recognition Payment System Prototype - MOZI ***"
img_database_location="C:\\mozi\\backend\\photos"

amount = raw_input("Enter amount for transaction: $")
imgName=raw_input("Enter the JPG test image filename (located in photos\\test): ")
receiverUser=1

imgTestLocation="C:\\mozi\\backend\\photos\\test\\"+imgName+".jpg"
outLocation="C:\\mozi\\backend\\photos\\test\\"+imgName+"_cropped"+".jpg"

#detect Face in Photo

analyzeImg=faceDetect(imgTestLocation)
faceFound=analyzeImg.analyze(outLocation)

#ID user and initiate payment
if faceFound==True:
    analyzeImg=faceRecognition(outLocation,img_database_location)
    user_identity=analyzeImg.analyze()

    userInfo=user_identity.split("\\")
    userInfo=userInfo[-1]
    userID=userInfo.split("_")[1]

    ######userID discovered###

    pullUser=readDatabase()
    userInfo=pullUser.getNameAndEmail(userID)

    print "Hello "+userInfo[0]+"! Initiating Payment for "+amount

    ##send and wait for confirmation
    ####SMS???
    ##proceed 
    
    recordTransaction=payDatabase()
    amount=float(amount)
    payAmount=amount*1.029+.30  #2.9%+.30 for transaction
    payAmount=math.ceil(payAmount*100)/100
    recordTransaction.debitSender(userID,payAmount)
    recordTransaction.creditReceiver(receiverUser,amount)

    amount_in_cents = int(float("%0.2f" % (float(payAmount)*100))) # payment USD
    payComments="not yet available"
    buyer = balanced.Account.query.filter(email_address=userInfo[2])[0]
    debit = buyer.debit(int(amount_in_cents), appears_on_statement_as='MOZI TWITTER PURCHASE',description=payComments)
    
    print "DONE"                             
    

else:
    print "No face detected in photo. Please take another photo!"
    




        
        
