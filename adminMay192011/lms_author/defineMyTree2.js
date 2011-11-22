// You can find instructions for this file here:
// http://www.treeview.net

// Decide if the names are links or just the icons
USETEXTLINKS = 1  //replace 0 with 1 for hyperlinks

// Decide if the tree is to start all open or just showing the root folders
STARTALLOPEN = 0 //replace 0 with 1 to show the whole tree

// Decide if the tree is to to be shown on a separate frame of its own
USEFRAMES = 0

// Remove the folder and link icons
USEICONS = 0

// Make the folder and link labels wrap into multiple lines
WRAPTEXT = 1

// Folders reopen to +revious state across page loads
PERSERVESTATE = 1


foldersTree = gFld("<i>Been There</i>", "framelessTree.html")
	aux1 = insFld(foldersTree, gFld("Pictures, flags, and maps from Europe", "framelessTree.html?pic=\"beenthere_europe.gif\""))
	      aux2 = insFld(aux1, gFld("United Kingdom", "framelessTree.html?pic=\"beenthere_unitedkingdom.gif\""))
		      aux3 = insFld(aux2, gFld("Scotland and Loch Ness", "framelessTree.html?pic=\"beenthere_scotland.jpg\""))
				insDoc(aux3, gLnk(0, "Edinburgh", "framelessTree.html?pic=\"beenthere_edinburgh.gif\""))
 			insDoc(aux2, gLnk(0, "London", "framelessTree.html?pic=\"beenthere_london.jpg\""))
		  aux2 = insFld(aux1, gFld("Germany", "framelessTree.html?pic=\"beenthere_germany.gif\""))
 			insDoc(aux2, gLnk(0, "Munich", "framelessTree.html?pic=\"beenthere_munich.jpg\""))
	      aux2 = insFld(aux1, gFld("Greece", "framelessTree.html?pic=\"beenthere_greece.gif\""))
 			insDoc(aux2, gLnk(0, "Athens", "framelessTree.html?pic=\"beenthere_athens.jpg\""))
	      aux2 = insFld(aux1, gFld("Italy", "framelessTree.html?pic=\"beenthere_italy.gif\""))
		      aux3 = insFld(aux2, gFld("Tuscany", "framelessTree.html?pic=\"beenthere_tuscany.gif\""))
				insDoc(aux3, gLnk(0, "Florence", "framelessTree.html?pic=\"beenthere_florence.jpg\""))
				insDoc(aux3, gLnk(0, "Pisa", "framelessTree.html?pic=\"beenthere_pisa.jpg\""))
			insDoc(aux2, gLnk(0, "Rome", "framelessTree.html?pic=\"beenthere_rome.jpg\""))
	      aux2 = insFld(aux1, gFld("Portugal", "framelessTree.html?pic=\"beenthere_portugal.gif\""))
 			insDoc(aux2, gLnk(0, "Lisboa", "framelessTree.html?pic=\"beenthere_lisbon.jpg\""))
     aux1 = insFld(foldersTree, gFld("Pictures, flags, and maps from North America", "framelessTree.html?pic=\"beenthere_america.gif\""))
	      aux2 = insFld(aux1, gFld("Canada", "framelessTree.html?pic=\"beenthere_canada.gif\""))
 			insDoc(aux2, gLnk(0, "Montreal", "framelessTree.html?pic=\"beenthere_montreal.jpg\""))
	      aux2 = insFld(aux1, gFld("United States", "framelessTree.html?pic=\"beenthere_unitedstates.gif\""))
 			insDoc(aux2, gLnk(0, "Boston", "framelessTree.html?pic=\"beenthere_boston.jpg\""))
 			insDoc(aux2, gLnk(0, "Tiny pic of New York City", "framelessTree.html?pic=\"beenthere_newyork.jpg\""))
 			insDoc(aux2, gLnk(0, "Washington", "framelessTree.html?pic=\"beenthere_washington.jpg\""))
     aux1 = insFld(foldersTree, gFld("Test A", ""))
		      aux2 = insFld(aux1, gFld("Test B", "framelessTree.html?pic=\"beenthere_athens.jpg\""))
              insDoc(aux1, gLnk(1, "Test C", "www.mmartins.com/panoramas"))
 