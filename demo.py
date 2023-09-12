import pywhatkit as p
import datetime as t
import mysql.connector

# Establish connection to the database
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="food-order"
)

# Create a cursor object
mycursor = mydb.cursor()

# Execute a SELECT statement to retrieve a specific value
mycursor.execute("SELECT * FROM tbl_order WHERE id =(SELECT max(id) FROM tbl_order)")

# Retrieve the value using fetchone() method
result = mycursor.fetchall()

id=result[0][0]
id=str(id)
food=result[0][1]
price=result[0][2]
price=str(price)
qty=result[0][3]
qty=str(qty)
total=result[0][4]
total=str(total)
status=result[0][6]
name=result[0][7]
address=result[0][10]
phone=result[0][8]
phone="+91"+str(phone)

msg="Transtaction_id:"+id+"\nName:"+name+"\nFood_Name: "+food+"\nPrice:"+price+"\nQuantity:"+qty+"\nTotal:"+total+"\nStatus:"+status+"\nAddress:"+address+"\nStay Tune"

lt = t.datetime.now()
h=lt.hour
m=lt.minute

p.sendwhatmsg(phone,msg,h,m+1)

