import cv
print "loaded"
image="C:\\mozi\\backend\\photos\\Image48.jpg"
storage = cv.CreateMemStorage()
haar=cv.LoadHaarClassifierCascade('haarcascade_frontalface_default.xml')
detected = cv.HaarDetectObjects(image, haar, storage, 1.2, 2,cv.CV_HAAR_DO_CANNY_PRUNING, (100,100))
if detected:
    
    for face in detected:
        
        print face
