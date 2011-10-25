// You can find instructions for this file here:
// http://www.treeview.net

// Decide if the names are links or just the icons
USETEXTLINKS = 0  //replace 0 with 1 for hyperlinks

// Decide if the tree is to start all open or just showing the root folders
STARTALLOPEN = 1 //replace 0 with 1 to show the whole tree


foldersTree = gFld("&nbsp;<B>How To Race Correctly</B>", "startPage.html")
foldersTree.iconSrc = "images/course_folder_tree.gif"
	insDoc(foldersTree, gLnk(1, "&nbsp;Introduction to Racing", "http://www.yahoo.com"))
	aux1 = insFld(foldersTree, gFld("Part 1: How to Race", "http://www.xlweb.net"))

	insDoc(aux1, gLnk(2, "&nbsp;Adjusting the Seat Belt", "http://www.learningtouch.com"))	
	insDoc(aux1, gLnk(4, "&nbsp;Adjusting the Seat Belt", "http://www.learningtouch.com"))	
	insDoc(aux1, gLnk(5, "&nbsp;Adjusting the Seat Belt", "http://www.learningtouch.com"))	
	insDoc(aux1, gLnk(6, "&nbsp;Adjusting the Seat Belt", "http://www.learningtouch.com"))	
	insDoc(aux1, gLnk(7, " Adjusting the Seat Belt", "http://www.learningtouch.com"))	
	
	insDoc(aux1, gLnk(3, "&nbsp;Starting your car", "http://www.google.com"))			
	
	aux1 = insFld(foldersTree, gFld("Part 1: How to Race", "http://www.xlweb.net"))

	insDoc(aux1, gLnk(2, "&nbsp;Adjusting the Seat Belt", "http://www.learningtouch.com"))	
	insDoc(aux1, gLnk(4, "&nbsp;Adjusting the Seat Belt", "http://www.learningtouch.com"))	
	insDoc(aux1, gLnk(5, "&nbsp;Adjusting the Seat Belt", "http://www.learningtouch.com"))			
				
	test1 = insDoc(foldersTree, gLnk(2, "&nbsp;Adjusting the Seat Belt", "http://www.learningtouch.com"))					
	test1.iconSrc = "images/test_object_tree.gif"
		  //aux1.iconSrc = "images/diffFolder.gif"
		  //aux1.iconSrcClosed = "images/diffFolder.gif"
          //docAux = insDoc(aux1, gLnk(1, "D/L FolderTree", "www.treeview.net/ft/ftdistribution/ftv21.zip"))
		  //docAux.iconSrc = "images/diffDoc.gif"

