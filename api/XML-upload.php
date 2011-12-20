<center>
<h2>POST Mock XML Order to 'course-purchased.php'</h2>
<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="course-purchased.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Name of input element determines name in $_FILES array -->
    XML POST Data: <textarea name="xml" id="xml">
	&gt; &lt;?xml version=\&quot;1.0\&quot; encoding=\&quot;UTF-8\&quot; ?&gt; &lt;CreateOrder xmlns=\&quot;\&quot;&gt;&lt;Timestamp&gt;2011-12-16T20:51:00Z&lt;/Timestamp&gt;&lt;Store&gt;https://www.californiaeducationconnection.com&lt;/Store&gt;&lt;OrderID&gt;24644&lt;/OrderID&gt;&lt;InvoiceNumber&gt;3ON2520&lt;/InvoiceNumber&gt;&lt;Date&gt;12/14/2011&lt;/Date&gt;&lt;Student&gt;&lt;FirstName&gt;Betty&lt;/FirstName&gt;&lt;LastName&gt;Shaw&lt;/LastName&gt;&lt;Email&gt;twokos@aol.com&lt;/Email&gt;&lt;Address&gt;11424 Oneonta Knoll&lt;/Address&gt;&lt;Address2&gt;&lt;/Address2&gt;&lt;City&gt;South Pasadena&lt;/City&gt;&lt;ZipCode&gt;91030&lt;/ZipCode&gt;&lt;StateCode&gt;CA&lt;/StateCode&gt;&lt;CountryCode&gt;US&lt;/CountryCode&gt;&lt;Phone&gt;951-990-1599&lt;/Phone&gt;&lt;Company&gt;&lt;/Company&gt;&lt;IP&gt;166.250.64.186&lt;/IP&gt;&lt;/Student&gt;&lt;Course&gt;&lt;CourseID&gt;CEAPPIND&lt;/CourseID&gt;&lt;CourseName&gt;CE Application Fee Individual RUSH FEE: RUSH FEE&lt;/CourseName&gt;&lt;CoursePrice&gt;35&lt;/CoursePrice&gt;&lt;/Course&gt;&lt;/CreateOrder&gt;
	</textarea>
    <input type="submit" value="Send File" />
</form>

</center>