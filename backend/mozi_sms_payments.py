### Need to be fully integrated. This version can only send to pre-defined networks (ATT in this example)
### Once integrated with network checker, it will work for all US numbers
###
###


import MySQLdb as mdb
import time,imaplib
import balanced, math

from datetime import datetime, timedelta
import email
from imapclient import IMAPClient

key_secret = '5340a9843f6b11e28447026ba7cd33d0'
balanced.configure(key_secret)

class readDatabase():
    def __init__(self):
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        print "connected to sql server"

    def checkMember(self, number): #search by User phone number
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT id FROM tbl_user WHERE cellNumber=%s", (number))
        data=cur.fetchall()
        self.member=[False,[00]]
        if len(data)==1: #twitter handle
            self.member=[True, data[0]]

        return self.member

    def getSenderName(self, number): #search by User phone number
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT firstName FROM tbl_user WHERE id=%s", (number))
        data=cur.fetchall()
        return data

    def getSenderEmail(self, number): #search by User phone number
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT email FROM tbl_user WHERE id=%s", (number))
        data=cur.fetchall()
        return data 

class payDatabase:
    def __init__(self):
        return

    def getTransInfo(self, transID):#
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT amount, senderId, recieverId FROM tbl_transaction WHERE id=%s", (transID))
        data=cur.fetchall()
        return data
    
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

    def newTransaction(self,sendID, receiveID, amount,description,tracking): #last value is 0 because transaction is pending
        newtime=time.strftime('%Y-%m-%d %H:%M:%S')
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("INSERT INTO tbl_transaction (recieverId, senderId, amount, description, date, status, paymentType, paymentTypeId, tweetId, paymentTracking) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", (receiveID, sendID, amount, description, newtime, 0, 0, 2147483647, 00, 0))
        #cur.execute("SELECT * FROM tbl_transaction WHERE date=%s and recieverId=%s", (newtime, receiveID))
        #data=cur.fetchall()
        #print data    FOR DEBUGGING
        return

    def searchPendingTransaction(self, userID):
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT id FROM tbl_transaction WHERE recieverId=%s AND paymentTracking=0", (userID))
        data=cur.fetchall()
        return data

    def acceptSMSTransaction(self, transID):
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("UPDATE tbl_transaction SET paymentTracking=1 WHERE id=%s", (transID))

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
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT balance FROM tbl_user WHERE id=%s", (userID))
        balance=cur.fetchall()
        balance=balance[0][0]
        balance=balance-amount
        print "sender",userID
        print balance
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("UPDATE tbl_user SET balance=%s WHERE id=%s", (balance,userID))
        
class SMSNotify:
    def __init__(self):
        import smtplib
        self.server=smtplib.SMTP("smtp.gmail.com",587)
        self.server.starttls()
        self.server.login('mozipay@gmail.com','ideareef2012')
        self.carrier=None

        self.carrierRef={
            'att':'mms.att.net',
            'verizon':'vtext.com',
            'virgin':'vmobl.com',
            'sprint':'messaging.sprintpcs.com',
            'tmobile':'tmomail.net',
            'metroPCS':'mymetropcs.com',
            'tracfone':'mmst5.tracfone.com',
            'uscellular':'email.uscc.net',
            'alltel':'message.alltel.com'
            }

    def checkCarrier(self):
        #check carrier address for SMS gateway
        #this will cost $
        #self.carrier=whatever is outputted

        self.carrierRef={
            'att':'mms.att.net',
            'verizon':'vtext.com',
            'virgin':'vmobl.com',
            'sprint':'messaging.sprintpcs.com',
            'tmobile':'tmomail.net',
            'metroPCS':'mymetropcs.com',
            'tracfone':'mmst5.tracfone.com',
            'uscellular':'email.uscc.net',
            'alltel':'message.alltel.com'
            }
        
        return

    def send(self, number, amount, senderID):
        #shotgun approach without carrier check
        chkmem=readDatabase()
        memberStatus=chkmem.checkMember(number)
        senderName=chkmem.getSenderName(senderID)[0][0]
        receiverID=memberStatus[1][0]

        trans=payDatabase()
        #unclaimed transactions (recipients with no Mozi account are given UserID = 0)####
        trans.newTransaction(senderID, receiverID, amount, "no description yet", 0)
        print "transaction recorded"
        
        self.carrier=self.carrierRef['att']
        outNum=number+'@'+self.carrier
        print outNum

        pendingTrans=trans.searchPendingTransaction(receiverID)
        newSMStransID=len(pendingTrans)

        #eventually collect sender and receiver information from interface...php interface?

        if memberStatus[0] == True:
            messPrefix=senderName+" has sent you $"
            messID="'accept "+str(newSMStransID)+"'"
            self.server.sendmail('mozipay@gmail.com',outNum, messPrefix+amount+" on Mozi. Reply "+messID+" to accept the funds")
        else:
            messPrefix=senderName+" has sent you $"
            self.server.sendmail('mozipay@gmail.com',outNum, messPrefix+amount+' on Mozi. Go to www.mozime.com/signup to accept the funds!')

        print 'done'
        return outNum


        
        
#################################### interface integration ###########3333

sender=raw_input("Enter sender's mozi member ID: ")
receiver=raw_input("Enter receiver mobile number: ")
amount=raw_input("Enter amount to transfer: $")

sendMoney=SMSNotify()
listenReceiver=sendMoney.send(receiver,amount,sender)


###listen for response

print listenReceiver
raw_input("enter to continue")

#imap 
HOST = 'imap.gmail.com'
USERNAME = 'mozipay'
PASSWORD = 'ideareef2012'
ssl = True

today = datetime.today()
cutoff = today - timedelta(days=7)

## Connect, login and select the INBOX
server = IMAPClient(HOST, use_uid=True, ssl=ssl)
server.login(USERNAME, PASSWORD)
select_info = server.select_folder('INBOX')

## Search for relevant messages
## see http://tools.ietf.org/html/rfc3501#section-6.4.5
messages = server.search(
    ['FROM "%s"' % listenReceiver, 'SINCE %s' % cutoff.strftime('%d-%b-%Y')])
response = server.fetch(messages, ['RFC822'])

for msgid, data in response.iteritems():
    msg_string = data['RFC822']
    msg = email.message_from_string(msg_string)
    senderAddress=msg['Return-Path']
    senderAddress=senderAddress.strip("><")
    senderAddress=senderAddress.split("@")[0]
    senderInfo=readDatabase()
    senderID=senderInfo.checkMember(senderAddress)[1][0]
    body=str(msg)
    body=body.split("\r\n")

    #NEED TO DELETE READ EMAIL
    for element in range(len(body)):
        body[element]=body[element].strip()
        if 'accept' in body[element] or 'Accept' in body[element]:
            resp=body[element]
            resp=resp.split()
            transIndex=0
            for i in range(len(resp)):
                try:
                    int(resp[i])
                    transIndex=int(resp[i])
                except:
                    dummyVal=0

            trans=payDatabase()
            allUserTrans=trans.searchPendingTransaction(senderID)
            transID=allUserTrans[transIndex-1]

            transData=trans.getTransInfo(transID)[0]
            receiverID=transData[2]
            payAmount=transData[0]
            payAmountReceiver=payAmount
            payAmount=payAmount*1.029+.30
            payAmount=math.ceil(payAmount*100)/100

            #process payment from sender and receiver
            #need payAmount from Database
            #need payerInfo and senderInfo (email address, user numbers)
            ######################################################################
            payComments="not available yet"
            amount_in_cents = int(float("%0.2f" % (float(payAmount)*100))) # payment USD

            getEmail=readDatabase()
            senderEmail=getEmail.getSenderEmail(senderID)[0][0]

            print senderEmail
            print amount_in_cents
            
            buyer = balanced.Account.query.filter(email_address=senderEmail)[0]
            debit = buyer.debit(int(amount_in_cents), appears_on_statement_as='MOZI TWITTER PURCHASE',description=payComments)

            changeStatus=payDatabase()

            print "crediting receiver "+str(payAmountReceiver)
            changeStatus.creditReceiver(int(receiverID),payAmountReceiver)
            
            print "debiting sender "+str(payAmount)
            changeStatus.debitSender(int(senderID),payAmount)



            
            trans.acceptSMSTransaction(transID)
            print "done"
            



    
