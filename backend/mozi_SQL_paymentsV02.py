import os,glob
import tweetstream, random
import MySQLdb as mdb
import pusher, json
import logging

##initialize outgoing tweets 
import sys
import tweepy
import time,math

#notification sync with mozi
mozi_app_id='34552'
mozi_secret='57d22d37931060f92e98'
mozi_api_key='721c7d62cacee28479b2'

#twitter app (MoziProto) initiation
CONSUMER_KEY = 'Jta9mhWiqMQSVYx1QVBAdQ'
CONSUMER_SECRET = 'DV44MfS0mbGpthdDJ9oZtZIw8mdxxVfa8v8egLE6XM'
ACCESS_KEY = '269648631-SucY4stSpGVJnkmMqDfr5pomLaKblQzXtFhyHbEw'
ACCESS_SECRET = 'a7eZaj1F6Aohbn4O6UuegrqBcH6Qv0ki9zWYAmDidj8'

auth = tweepy.OAuthHandler(CONSUMER_KEY, CONSUMER_SECRET)
auth.set_access_token(ACCESS_KEY, ACCESS_SECRET)
api = tweepy.API(auth)


#BalancedPayments.com marketplace initiation
import balanced
key_secret = '5340a9843f6b11e28447026ba7cd33d0'
balanced.configure(key_secret)

totalPaymentAmount=0.0

#initiate logger for debug and error
logger = logging.getLogger('mozi_SQL_paymentsV01')
hdlr = logging.FileHandler('moziTwitterPayments.log')
formatter = logging.Formatter('%(asctime)s %(levelname)s %(message)s')
hdlr.setFormatter(formatter)
logger.addHandler(hdlr) 
logger.setLevel(logging.INFO) #ignoring debug, info


class readDatabase():
    def __init__(self):
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        
    def get(self):
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT * FROM tbl_user")
        data=cur.fetchall()
        for row in data:
            self.database.append(row)
            
        return self.database

    def pullTwitterHandles(self):
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT * FROM tbl_user")
        data=cur.fetchall()
        for row in data:
            self.database.append(row)

        self.twitterHandles=[]

        for user in range(len(self.database)):
            if self.database[user][22]!= None:
                self.twitterHandles.append(self.database[user][22])

        return self.twitterHandles


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

    def getIDandEmail(self, twitterName): #get moziID number from twitterName
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT id, email FROM tbl_user WHERE twitterId=%s",(twitterName))
        data=cur.fetchall()
        return data[0]
        

    def userInfo(self, userID): #search by User Twitter Handle [-2] ... User Mozi Name = [3]
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT * FROM tbl_user")
        data=cur.fetchall()
        for row in data:
            self.database.append(row)

        info=[]

        for user in range(len(self.database)):
            if userID == self.database[user][22]: #twitter handle
                info=self.database[user]

        return info

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
        print balance
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        res=cur.execute("UPDATE tbl_user SET balance=%s WHERE id=%s", (balance,userID))
        print res
            

    def debitSender(self, userID, amount):#
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("SELECT balance FROM tbl_user WHERE id=%s", (userID))
        balance=cur.fetchall()
        balance=balance[0][0]
        balance=balance-amount
        print balance
        self.con=mdb.connect('mozime.com','mozi','team4625','mozi_main')
        self.database=[]
        cur=self.con.cursor()
        cur.execute("UPDATE tbl_user SET balance=%s WHERE id=%s", (balance,userID))
        

    
##################################################################

print "Mozi Demonstration"

databaseRead=readDatabase()
userData=databaseRead.pullTwitterHandles()
logger.debug("0-0 Pulling Twitter Handles from Database")

print userData

users=[]
logger.debug("0-1 Indentifying Twitter IDs from Handles")
for user in range(len(userData)):
    userSearch=api.get_user(userData[user])
    userID=userSearch.id
    users.append(userID)

with tweetstream.FollowStream("myMozi","mozi2012",users) as stream:
    logger.debug("0-2 Listening for Tweets from Mozi Users")
    for tweet in stream:
        logger.debug("Tweet Match to User Identified")
        try:
            tweetID=tweet[u'id']
            replyTweetID=tweet[u'in_reply_to_status_id']

            for hashtag in range(len(tweet[u'entities'][u'hashtags'])):
                if tweet[u'entities'][u'hashtags'][hashtag][u'text'] == 'pay':
                    logger.info("Tweet with #Pay identified")
                    logger.debug("proccessing tweet to validate payer & recipient and initate payment process")
                    detect=0
                    #tweet only allowed 1 user per transaction
                    if len(tweet[u'entities'][u'user_mentions'])>1:
                        message="@"+"%s you can only send money to one user at a time."%str(tweet[u'user'][u'screen_name'])
                        print message
                        logger.warning("ERROR: User sent to multiple twitter users")
                        logger.warning(message)
                        api.update_status(message)
                    
                    else:
                        #check to see if users are mozi members  
                        senderName= str(tweet[u'user'][u'screen_name'])
                        try: #filter for users that don't exist
                            recipientName=str(tweet[u'entities'][u'user_mentions'][0][u'screen_name'])
                            logger.debug("recipient exists on Twitter")
                        except IndexError:
                            submessage="@%s, that user does not exist on Twitter. Try fixing the recipient name! "%str(tweet[u'user'][u'screen_name'])
                            now=time.strftime("%b %d %H:%M:%S")
                            message=submessage+str(now)
                            api.update_status(message)
                            logger.warning("ERROR: User attempted to send to user not on Twitter.")
                            logger.warning(message)
                            detect=1
                            pass

                        print "detect =",detect
                        
                        if detect==1:
                            pass

                        else:

                            #global check to make sure both users are fully registered
                            logger.debug("checking for twitter user membership with Mozi...")
                            chkmem = readDatabase()
                            test=[chkmem.checkMember(senderName),chkmem.checkMember(recipientName)]
                            
                            
                            if test!=[True,True]:
                                logger.debug("both twitter useres are mozi members")
                                if chkmem.checkMember(senderName)==False: #ALSO NEEDS BANK ACCOUNT CHECK!
                                    subMessage="@%s you need to link an account before you can send money! "%senderName
                                    message=subMessage+str(time.strftime("%b %d %H:%M:%S"))
                                    logger.warning("sender does not have account linked to mozi")
                                    api.update_status(message)

                                if chkmem.checkMember(recipientName)==False: #ALSO NEEDS BANK ACCOUNT CHECK
                                    #tell sender that recipient isn't registered
                                    subMessage="@%s , user %s needs to register before you can send him money!"%(senderName,recipientName)
                                    message=subMessage
                                    logger.warning("recipient does not have registered accounts with Mozi")
                                    logger.debug("send message to sender that recipient is not registerd")
                                    api.update_status(message)
                                    #tweet to recipient that money is awaiting
                                    subMessage="@%s , @%s wants to send you money using Mozi! Register at www.mozime.com to get it! "%(recipientName, senderName)
                                    message=subMessage+str(time.strftime("%b %d %H:%M:%S"))
                                    logger.debug("send message to recipient to join Mozi to accept")
                                    api.update_status(message)

                            else:  #proceed with transaction
                                logger.info("initiating pending transaction")
                                logger.debug("parsing tweet text string and identifying payment numbers")
                                #this will break if other numbers included
                                tweetText=str(tweet[u'text'])
                                tweetText=tweetText.split(" ")
                                for i in range(len(tweetText)):
                                    tweetText[i]=tweetText[i].strip('$')
                                
                                index=[] 
                                for i in range(len(tweetText)):
                                    try:
                                        float(tweetText[i])
                                        index.append(1)
                                    except:
                                        index.append(0)

                                payAmountDeclared=tweetText[index.index(1)]


                                #select Accounts based on e-mail of users
                                logger.debug("identifying users emails and mozi IDs")
                                senderData=readDatabase()
                                senderInfo=senderData.getIDandEmail(senderName)
                   
                                recipientInfo=senderData.getIDandEmail(recipientName)
                             

                                payComments="not yet defined"


                                #record transaction on mozi
                                
                                payData=payDatabase()
                                logger.info("pushing new pending transaction to tbl_transaction")
                                trans=payData.newTransaction(senderInfo[0],recipientInfo[0],payAmountDeclared,payComments,tweetID,0)
                                trans_id=trans[0][0]

                                #debit/credit accounts
                                
            

                                
                                pusher.app_id=mozi_app_id
                                pusher.key=mozi_api_key
                                pusher.secret=mozi_secret


                                encode_data= {"message":"new transaction pending","transactionId":trans_id,"type":"1"}
                                encode_data= json.dumps(encode_data)
                                
                                p=pusher.Pusher()
                                p['private_'+str(recipientInfo[0])].trigger('my_event', encode_data)
                                logger.debug("notification sent to mozime account")

                                
                                logger.info("payment is pending")

            #payment pending complete
            #listen for accepted payments

                    
                            
            for hashtag in range(len(tweet[u'entities'][u'hashtags'])):
                if tweet[u'entities'][u'hashtags'][hashtag][u'text'] == 'accept':
                    logger.info("Tweet with #accept request detected")
                    logger.debug("check to see if user is the user recieving the funds")
                    print "accept detected"
                    if replyTweetID != None:
                        search=payDatabase()
                        transaction=search.searchTweetTransaction(replyTweetID)[0]
                        logger.debug("finding pending transactions based on reply to tweet ID")
                        

                        senderName= str(tweet[u'user'][u'screen_name'])
                        senderData=readDatabase()
                        senderInfo=senderData.getIDandEmail(senderName)

                        payerName=str(tweet[u'entities'][u'user_mentions'][0][u'screen_name'])
                        payerData=readDatabase()
                        payerInfo=senderData.getIDandEmail(payerName)

                        validTrans=transaction[9]==replyTweetID
                        idReceiver=transaction[1]==senderInfo[0]
                        trans_id=transaction[0]

                        if validTrans==True: #check for reply (validates tweet to initiated tweet
                            logger.debug("transaction identified based on reply tweet ID")
                            if idReceiver==True:  #check for recipient
                                logger.debug("receiver identified correctly to accept payment")
                                if transaction[10]==0: #check for pending, hasn't already been accepted
                                    logger.debug("transaction has not already been processed")
                                    logger.info("Transaction undergoing processing")

                                    payAmountReceiver=transaction[4]
                                        
                                    payAmount=transaction[4]
                                    logger.info("User is sending "+str(payAmount))
                                    payAmount=payAmount*1.029+.30  #2.9%+.30 for transaction
                                    payAmount=math.ceil(payAmount*100)/100
                                    logger.info("Mozi is charging "+str(payAmount))


                                    ##USE TO DETERMINE CORRECT ACCOUNT or implement system for default payment found within linkedCreditCard
                                    #senderPayData=payDatabase()
                                    #creditInfo=senderPayData.linkedCreditCard(payerInfo[0]) #moziID
                                    ###!!!This process will continue once our flow is correct, assume now default selected we search by e-mail on balanced
                                    

                                    #initate transaction from buyer
                                    payComments="not available yet"
                                    amount_in_cents = int(float("%0.2f" % (float(payAmount)*100))) # payment USD
                                    logger.debug("communicating with Balanced Payments")
                                    logger.debug("searching for registered payment credentials by email")
                                    buyer = balanced.Account.query.filter(email_address=payerInfo[1])[0]
                                    logger.debug("pushing debit transaction from sender account")
                                    debit = buyer.debit(int(amount_in_cents), appears_on_statement_as='MOZI TWITTER PURCHASE',description=payComments)
                                    logger.info("Balanced Payments accepted transactions")


                                    changeStatus=payDatabase()
                                    changeStatus.acceptTweetTransaction(replyTweetID)
                                    logger.debug("transaction changed from 0 to 1 .. accepted")

                                    logger.debug("crediting receiver")
                                    print "crediting receiver "+str(payAmountReceiver)
                                    changeStatus.creditReceiver(payerInfo[0],payAmountReceiver)
                                    
                                    logger.debug("debiting sender")
                                    print "debiting sender "+str(payAmount)
                                    changeStatus.debitSender(senderInfo[0],payAmount)

                                    logger.info("Balances Updated on Mozi Database")


                                    #push notification to mozime.com
                                    encode_data= {"message":"new transaction accepted","transactionId":trans_id,"type":"2"}
                                    encode_data= json.dumps(encode_data)
                                    p=pusher.Pusher()
                                    p['private_'+str(payerInfo[0])].trigger('my_event', encode_data)
                                    logger.debug("pushed notification to mozime")

        
                                    submess="@%s @%s, payment "%(senderName,payerName)
                                    now=time.strftime("%b %d %H:%M:%S")
                                    message= submess+"has been accepted at "+str(now)+"."

                                    print message
                                    api.update_status(message)
                                    logger.debug("payer and buyer identified payment status is changed")

                                    logger.info("Payment accepted into Balanced Payment account for Mozi")

                                else:
                                    logger.info("Payment already accepted")
                                    now=time.strftime("%b %d %H:%M:%S")
                                    submess="@%s"%(senderName)
                                    message=submess+", you have already accepted that payment on "+str(now)+"!"
                                    api.update_status(message)
                                    


        except KeyError:
            pass
                                



###END

###### balanced payments marketplace interactions #########
##
##
###################### Biz Search for User & Request Payment Method via Tweet ######################################
##    
##print "Welcome to Mozi Prototype v 0.2"
##print
##print "Twitter-based Payment System for Business - Test Protype"
##print
##
##print "Enter the following number to demonstrate the corresponding functionality"
##print "1 - Business Initiated Transaction (BIT): payment request sent by business to Mozi user (i.e.-seated at restaurant @ traditional time of payment/closing check)"
##print "2 - Simulated Registration Process: user sends tweet to @myMozi to begin registering"
##print "3 - Customer Initated Transaction (CIT): order request sent by customer to Mozi for Merchant/Business (i.e.- pizza delivery order)"
##print 
##option = input("Please enter an option: ")
##
##if option == 1: 
#####
##    searchUser=raw_input("Search for Mozi payer by Twitter screen name: ")
##    query=searchDatabase(searchUser)
##    searchReturn=query.getID()
##    if searchReturn[0]==True:
##        print "Mozi member verified"
##        payAmount = raw_input("Enter amount to charge user: ")
##        payComments = raw_input("Enter purchase comments (optional): ")
##        totalPaymentAmount+= float(payAmount)
##        print "Charging "+searchReturn[1]+" for $"+payAmount+". Please wait for user authorization (via tweet reply)."
##        submessage = "@"+"%s "%searchUser
##        message = submessage+"accept charge from @myMOZI for $"+payAmount+" by replying #pay"
##        print message
##        api.update_status(message)
##
##        #create LOG event
##        logfile=open(os.getcwd()+"\\log.txt",'a')
##        logfile.write("Transaction requested [$"+payAmount+"] by (CTPAQUETTE) to ("+str(searchReturn[3])+") Reference Info:: Twitter ID: "+str(searchReturn[3])+" Email: "+searchReturn[2]+"\n")
##        logfile.close()
##        
##        words = ['myMozi'] #change for different user name
##
##        count=0
##        with tweetstream.TrackStream("myMozi","mozi2012",words) as stream:
##            for tweet in stream:
##                for hashtag in range(len(tweet[u'entities'][u'hashtags'])):
##                    if tweet[u'entities'][u'hashtags'][hashtag][u'text'] == 'pay':
##                        #process payment
##            
##                        amount_in_cents = float(payAmount) * 100  # payment USD
##                        buyer = balanced.Account.query.filter(email_address=searchReturn[2])[0]
##                        debit = buyer.debit(amount_in_cents, appears_on_statement_as='MOZI TWITTER PURCHASE',description=payComments)
##                        #record in LOG file
##                        logfile=open(os.getcwd()+"\\log.txt",'a')
##                        logfile.write("Transaction completed [$"+payAmount+"] by ("+searchReturn[1]+") to (CTPAQUETTE). Reference Info: Twitter ID:: "+searchReturn[2]+" Email: "+searchReturn[1]+"\n")
##                        logfile.close()
##                        print "Payment complete!"
##                        count+=1
##
##                if count!=0:
##                    break
#####                
##elif option == 2:
##    words=['myMozi']
##
##    randomSig=[', buddy',' pal',' friend',". Let's get started",'. Glad to see you on','. Welcome to Mozi','. We appreciate it', '. Welcome to the club']
##
##    with tweetstream.TrackStream("myMozi","mozi2012",words) as stream:
##        print "Connected to Twitter"
##        count=0
##        greetCount=int(round(random.uniform(0,7),0))
##        for tweet in stream:
##
##            realname=str(tweet[u'user'][u'name'])
##            userID=tweet[u'user'][u'id']
##            screen_Name=str(tweet[u'user'][u'screen_name'])
##
##            #new registration
##
##            #if user is new (check user registration), then commence with registration
##
##            query=searchDatabase(screen_Name)
##            searchReturn=query.getID()
##            #return [detect,self.userRealName,self.userEmail,self.userID]
##
##            if searchReturn[0]==False: #check to see if user in database
##                
##                for hashtag in range(len(tweet[u'entities'][u'hashtags'])):
##                    if tweet[u'entities'][u'hashtags'][hashtag][u'text'] == 'register':   #check to see if user is following us, so we can PM the user
##                        if api.exists_friendship(user_a=screen_Name,user_b='mymozi')==True:
##                            newUser=newRegister(realname,'none','none',userID,'none','none','none')
##                            newUser.publishRegister()
##                            rand_greet= randomSig[greetCount%len(randomSig)]
##                            subMessage="@"+"%s thank you for registering"%screen_Name
##                            messageUserRegURL = "www.mozime.com/new_user/35jaoyzj35135jlzi"
##                            message1=subMessage+rand_greet+"!"+" Finish registration here: "+messageUserRegURL
##                            message2=subMessage+rand_greet+"!"
##
##                              #send direct mesage with link to URL for registration
##                            api.send_direct_message(screen_name=screen_Name,text=message1)
##                            api.update_status(message2)
##                            #api.update_status(message)
##                            greetCount+=1
##                        else:
##                            subMessage="@"+"%s you need to follow @myMozi in order for us to message your registration link!"%screen_Name
##                            message=subMessage
##                            print message
##                            api.update_status(message)
##                            
##
##            else:
##                subMessage="@"+"%s you're already registered on Mozi. Start paying with your Twitter Name!"%screen_Name
##                message=subMessage
##                print message
##                api.update_status(message)
##                    
##              
##            
##            count+=1
##            if count!=0:
##                break
##
##    
####
##elif option == 3:
##    words = ['myMozi']
##    with tweetstream.TrackStream("myMozi","mozi2012",words) as stream:
##        print "Connected to Twitter"
##        count=0
##        greetCount=int(round(random.uniform(0,5),0))
##        for tweet in stream:
##            usertweet=str(tweet[u'text'])
##            realname=str(tweet[u'user'][u'name'])
##            userID=tweet[u'user'][u'id']
##            screen_name=str(tweet[u'user'][u'screen_name'])
##
##            #verification of user in Database
##            query=searchDatabase(screen_name)
##            searchReturn=query.getID()
##            
##            if searchReturn[0]==True:
##                #detect ORDER
##                randomSig=[', buddy',' pal',' friend','. Glad to see you on','. Welcome to Mozi','. We appreciate it']
##                
##                for hashtag in range(len(tweet[u'entities'][u'hashtags'])):
##          
##                    userOrder = usertweet
##
##                    if tweet[u'entities'][u'hashtags'][hashtag][u'text'] == 'order':  
##                        
##                        #detect PLACE for ORDER
##                        for place in range(len(tweet[u'entities'][u'hashtags'])):
##
##                            if tweet[u'entities'][u'hashtags'][place][u'text'] == 'home':
##            
##                
##                                location_Home = "142 Front St. Binghamton NY 13905"
##                                #searchQuery=readDatabase(os.getcwd())
##                                #search=searchQuery.userInfo(userID)
##                                #location_Home = search[8]
##                                
##                                #access database for user location corresponding to home & submit order to business
##                                orderfile="MoziOrder"+str(round(random.random(),5)*10)+".txt"
##                                newOrder = open(os.getcwd()+"\\orders\\"+orderfile,'w')
##                                newOrder.write(screen_name+"\t"+userOrder+"\t"+realname+"\t"+location_Home)
##                                newOrder.close()
##                                print "Done  "+orderfile
##
##                                #notification of tweet
##                                rand_greet= randomSig[greetCount%len(randomSig)]
##                                subMessage="@"+"%s thank you for your order"%screen_name
##                                message=subMessage+rand_greet+"! Your delivery will be there soon!"
##                                api.update_status(message)
##                                
##                    
##                            if tweet[u'entities'][u'hashtags'][place][u'text'] == 'work':
##
##                                location_Work = "4400 Vestal Pkwy E, Engineering Bldg 35071, Vestal NY 13905"
##                                #searchQuery=readDatabase(os.getcwd())
##                                #search=searchQuery.userInfo(userID)
##                                #location_Home = search[9]
##                                
##                                orderfile="MoziOrder"+str(round(random.random(),5)*10)+".txt"
##                                newOrder = open(os.getcwd()+"\\orders\\"+orderfile,'w')
##                                newOrder.write(screen_name+"\t"+userOrder+"\t"+realname+"\t"+location_Work)
##                                newOrder.close()
##                                print "Done  "+orderfile
##                                rand_greet= randomSig[greetCount%len(randomSig)]
##                                subMessage="@"+"%s thank you for your order"%screen_name
##                                message=subMessage+rand_greet+"! Your delivery will be there soon!"
##                                api.update_status(message)
##                                #
##                            
##                            if tweet[u'entities'][u'hashtags'][place][u'text'] == 'store':
##                    
##                                location = "In Store"
##
##                                #ORDER NUMBER?
##                                #orderNumber=getOrderNumber()  ..not yet created
##                                orderNumber=10
##                        
##                                orderfile="MoziOrder"+str(round(random.random(),5)*10)+".txt"
##                                newOrder = open(os.getcwd()+"\\orders\\"+orderfile,'w')
##                                newOrder.write(screen_name+"\t"+userOrder+"\t"+realname+"\t"+location)
##                                newOrder.close()
##                                print "Done  "+orderfile
##                                rand_greet= randomSig[greetCount%len(randomSig)]
##                                subMessage="@"+"%s thank you for your order"%screen_name
##                                message=subMessage+rand_greet+"! Your number is: "+str(orderNumber)
##                                api.update_status(message)
##                                
####                            else:
####                                print "ERROR!"
####                                greetCount+=1
####                                print tweet[u'entities'][u'hashtags']
####                                rand_greet= randomSig[greetCount%len(randomSig)]
####                                subMessage="@"+"%s there was an error with your order"%screen_name
####                                message=subMessage+rand_greet+"! Please use #home #work or #store"
####                                api.update_status(message)
####                                
####                            
##                                
##                        
##
##                        
##            else:
##                messqage = "Please register for Mozi first by following @myMozi and then tweeting @myMozi #register!"
##                api.update_status(message)
##                #send tweet asking for them to register
##                    
##              
##            
##            count+=1
##            if count!=0:
##                break

    
            

##########################################################################
            ################################################
    ###############################################################3



            ######################################33
            ##############################################33


            #############################################
    
    
    

##########################  Listen for New Registrations ############################
##        
####                
####
######listen for new registrations
##words=['ctpaquette']
##
##randomSig=[', buddy',' pal',' friend',' bud','. Glad to see you on','. Welcome to Mozi','. We appreciate it', '. Welcome to the club']
##
##with tweetstream.TrackStream("myMozi","mozi2012",words) as stream:
##    print "Connected to Twitter"
##    count=0
##    greetCount=0
##    for tweet in stream:
##
##        realname=str(tweet[u'user'][u'name'])
##        userID=tweet[u'user'][u'id']
##        screen_name=str(tweet[u'user'][u'screen_name'])
##
##        #new registration
##
##          #if user is new (check user registration), then commence with registration
##
##        for hashtag in range(len(tweet[u'entities'][u'hashtags'])):
##            if tweet[u'entities'][u'hashtags'][hashtag][u'text'] == 'register':
##                newUser=newRegister(realname,'none','none',userID,'none','none','none')
##                newUser.publishRegister()
##                rand_greet=randomSig[greetCount%len(randomSig)]
##                subMessage="@"+"%s thank you for registering"%screen_name
##                message=subMessage+rand_greet+"!"
##
##                  #send direct mesage with link to URL for registration
##                print message
##                api.update_status(message)
##                greetCount+=1
##                
##          
##        
##        count+=1
##        if count!=0:
##            break

######################### BIT Transaction #######################################
##searchUser=raw_input("Search for Mozi payer by Twitter screen name: ")
##query=searchDatabase(searchUser)
##searchReturn=query.getID()
##if searchReturn[0]==True:
##    print "Mozi member verified"
##    payAmount = raw_input("Enter amount to charge user: ")
##    payComments = raw_input("Enter purchase comments (optional): ")
##    totalPaymentAmount+= float(payAmount)
##    print "Charging "+searchReturn[1]+" for $"+payAmount+". Please wait for user authorization (via tweet reply)."
##    submessage = "@"+"%s "%searchUser
##    message = submessage+"accept charge from @myMOZI for $"+payAmount+" by replying #pay"
##    print message
##    api.update_status(message)
##
##    #create LOG event
##    logfile=open(os.getcwd()+"\\log.txt",'a')
##    logfile.write("Transaction requested [$"+payAmount+"] by (CTPAQUETTE) to ("+searchReturn[3]+") Reference Info:: Twitter ID: "+searchReturn[2]+" Email: "+searchReturn[1]+"\n")
##    logfile.close()
##    
##    words = ['myMozi'] #change for different user name
##
##    count=0
##    with tweetstream.TrackStream("myMozi","mozi2012",words) as stream:
##        for tweet in stream:
##            for hashtag in range(len(tweet[u'entities'][u'hashtags'])):
##                if tweet[u'entities'][u'hashtags'][hashtag][u'text'] == 'pay':
##                    #process payment
##        
##                    amount_in_cents = float(payAmount) * 100  # payment USD
##                    buyer = balanced.Account.query.filter(email_address=searchReturn[2])[0]
##                    debit = buyer.debit(amount_in_cents, appears_on_statement_as='MOZI TWITTER PURCHASE',description=payComments)
##                    #record in LOG file
##                    logfile=open(os.getcwd()+"\\log.txt",'a')
##                    logfile.write("Transaction completed [$"+payAmount+"] by ("+searchReturn[1]+") to (CTPAQUETTE). Reference Info: Twitter ID:: "+searchReturn[2]+" Email: "+searchReturn[1]+"\n")
##                    logfile.close()
##                    print "Payment complete!"
##                    count+=1
##
##            if count!=0:
##                break
##            

