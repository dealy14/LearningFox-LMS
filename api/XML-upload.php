<center>
<h2>POST Mock XML Order File to 'course-purchased.php'</h2>
<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="course-purchased.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="file" type="file"/>
    <input type="submit" value="Send File" />
</form>
<p>
    <a href="order.xml">Download the mock XML order file</a> in order to upload it...
    <br>
    <h4>
    (Right-click link, Save As...to your Desktop, then browse for/upload it above.)
    </h4>
</p>

</center>