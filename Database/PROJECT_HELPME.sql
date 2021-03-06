
CREATE TABLE User
(
  Last_Name VARCHAR(40) NOT NULL,
  First_Name VARCHAR(40) NOT NULL,
  Email VARCHAR(40) NOT NULL,
  Phone_Nr INT NOT NULL,
  ID INT NOT NULL AUTO_INCREMENT ,
  Bio VARCHAR(250) NOT NULL,
  Joined_date DATETIME NULL,
  PRIMARY KEY (ID) 
);

CREATE TABLE Messages
(
  time_s DATETIME NULL ,
  Message VARCHAR(1000) NOT NULL,
  ID INT NOT NULL,
  senderID INT NOT NULL,
  PRIMARY KEY (time_s),
  FOREIGN KEY (ID) REFERENCES User(ID),
  FOREIGN KEY (senderID) REFERENCES User(ID)
);

CREATE TABLE Bonds
(
  requested VARCHAR(3) NOT NULL DEFAULT 'NO',
  accepted VARCHAR(3) NOT NULL DEFAULT 'NO',
  friends VARCHAR(3) NOT NULL DEFAULT 'NO' ,
  ID INT NOT NULL ,
  requestingID INT NOT NULL ,
  FOREIGN KEY (ID) REFERENCES User(ID) ON DELETE CASCADE,
  FOREIGN KEY (requestingID) REFERENCES User(ID) ON DELETE CASCADE
);

CREATE TABLE Credit_Debit
(
  Amount DECIMAL(12,2) NOT NULL,
  Card_Number VARCHAR(16) NOT NULL,
  CVV_CV2 VARCHAR(3) NOT NULL,
  MM INT NOT NULL,
  YY INT NOT NULL,
  ID INT NOT NULL AUTO_INCREMENT,
  FOREIGN KEY (ID) REFERENCES User(ID) ON DELETE CASCADE
);

CREATE TABLE User_Interests
(
  Interests VARCHAR(50) NOT NULL,
  ID INT NOT NULL,
  PRIMARY KEY (Interests, ID),
  FOREIGN KEY (ID) REFERENCES User(ID) ON DELETE CASCADE
);

CREATE TABLE Service
(
  Description VARCHAR(200) NOT NULL,
  Location VARCHAR(30) NOT NULL,
  Service_ID INT NOT NULL AUTO_INCREMENT,
  Titles VARCHAR(25) NOT NULL,
  Time_created DATETIME NOT NULL,
  Time_ended DATETIME NOT NULL,
  Price DECIMAL(12,2) NOT NULL,
  ID INT NOT NULL ,
  takerID INT NOT NULL ,
  PRIMARY KEY (Service_ID),
  FOREIGN KEY (ID) REFERENCES User(ID),
  FOREIGN KEY (takerID) REFERENCES User(ID)
);

CREATE TABLE Rating
(
  Rating INT NOT NULL,
  Feedback VARCHAR (300) NOT NULL,
  ID INT NOT NULL ,
  Service_ID INT NOT NULL,
  PRIMARY KEY (ID, Service_ID),
  FOREIGN KEY (ID) REFERENCES User(ID),
  FOREIGN KEY (Service_ID) REFERENCES Service(Service_ID)
);

CREATE TABLE Payment
(
  verif_cr VARCHAR(3) NOT NULL DEFAULT 'NO' ,
  verif_cl VARCHAR(3) NOT NULL DEFAULT 'NO',
  complet VARCHAR (11) NOT NULL DEFAULT 'UNCOMPLETED',
  Service_ID INT NOT NULL,
  ID INT NOT NULL,
  PRIMARY KEY (Service_ID, ID),
  FOREIGN KEY (Service_ID) REFERENCES Service(Service_ID),
  FOREIGN KEY (ID) REFERENCES User(ID)
);

CREATE TABLE List_appl
(
  ID INT NOT NULL ,
  Service_ID INT NOT NULL ,
  PRIMARY KEY (ID, Service_ID),
  FOREIGN KEY (ID) REFERENCES User(ID),
  FOREIGN KEY (Service_ID) REFERENCES Service(Service_ID)
);

CREATE TABLE Service_Interests
(
  Interests VARCHAR(50) NOT NULL,
  Service_ID INT NOT NULL ,
  PRIMARY KEY (Interests, Service_ID),
  FOREIGN KEY (Service_ID) REFERENCES Service(Service_ID)
);

delimiter //
CREATE procedure remove_pc_cr()
		begin
		UPDATE Credit_Debit
		SET Credit_Debit.Amount=(Select Credit_Debit.Amount From Credit_Debit where Credit_Debit.ID=User.ID and Payment.ID=User.ID and Service.Service_ID=Payment.Service_ID) - (Select Price From Service where Service.Service_ID=Payment.Service_ID and Payment.ID=User.ID) ;
        
    end//
    
    delimiter //
CREATE procedure add_pc_cl()
		begin
		UPDATE Credit_Debit
		SET Credit_Debit.Amount=(Select Credit_Debit.Amount From Credit_Debit where Credit_Debit.ID=User.ID and User.ID=Service.takerID and Service.Service_ID=Payment.Service_ID) + (Select Price From Service where User.ID=Service.takerID) ;
        
    end//
    
CREATE procedure change_ver_cr()
		begin
		UPDATE Payment
		SET Payment.verif_cr=""; 
        
    end//    

CREATE procedure change_ver_cl()
		begin
		UPDATE Payment
		SET credit_debit.Amount=(Select credit_debit.Amount From credit_debit where credit_debit.ID=user.ID and user.ID=service.takerID and service.Service_ID=payment.Service_ID) + (Select Price From service where user.ID=service.takerID) ;
        
    end//

CREATE procedure search_res()
		begin
		SELECT  *
		FROM    Service
		WHERE   Service_Interests.Interests COLLATE UTF8_GENERAL_CI LIKE User.Interests and  Service_Interests.Service_ID=Service.Service_ID;
	
    end//