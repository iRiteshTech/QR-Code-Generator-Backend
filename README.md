\# QR Code Generator



\## Project Overview



A web-based QR Code Generator that allows users to generate QR codes from any URL or text. Generated QR codes are stored in a MySQL database and displayed in a history table with download functionality.



\## Features



\- Generate QR Codes from URL or Text

\- Input Validation

\- QR Code Preview

\- Save QR Codes in MySQL Database

\- QR Code History

\- Download Current QR Code

\- Download QR Codes from History

\- Date and Time Tracking

\- Multiple QR Sizes



\## Technologies Used



\- HTML

\- CSS

\- JavaScript

\- PHP

\- MySQL

\- XAMPP



\## Installation Steps



1\. Install XAMPP

2\. Start Apache and MySQL

3\. Copy project folder into htdocs

4\. Create database:

&#x20;  qr\_generator

5\. Import database table

6\. Open:

&#x20;  http://localhost/qr\_generator/



\## Database Setup



Database Name:

qr\_generator



Table Name:

qr\_history



Columns:

\- id

\- text\_url

\- qr\_image

\- created\_at


## Screenshots

### Main QR Generator Page
![Main QR Generator Page](Screenshot%202026-06-06%20160419.png)

### Generated QR Code
![Generated QR Code](Screenshot%202026-06-06%20160529.png)

### QR History Table
![QR History Table](Screenshot%202026-06-06%20160609.png)


\## Project Structure



qr\_generator/

│

├── index.php

├── db.php

├── save\_qr.php

├── get\_history.php

├── README.md



\## Author



Ritesh Raj Tiwary

Thinklar Internship Assessment 2026



