<%@ Import Namespace="System.Xml" %>
<%@ Import Namespace="System.Xml.XPath" %>

<script language="VB" runat="server">

'Relative file path to XML data
Dim strXmlFilePath as String = Server.MapPath("quiz.xml")

Dim xDoc as New XPathDocument(strXmlFilePath)
Dim xNav as XPathNavigator = xDoc.CreateNavigator
Dim xNodeIterator as XPathNodeIterator

'Initialize variables
Dim intTotalQuestion as Integer
Dim intQuestionNo as Integer = 1
Dim intScore as Integer = 0
Dim arrAnswerHistory as new ArrayList()

Sub Page_Load(src as Object, e as EventArgs)

	'Start a new quiz?
	If Not Page.IsPostBack Then

		'Yes! Count total question
		intTotalQuestion = xNav.Select("/quiz/mchoice").Count

		'Record start time
		ViewState("StartTime") = DateTime.Now

		ShowQuestion(intQuestionNo)
	End If
End Sub


Sub btnSubmit_Click(src as Object, e as EventArgs)

	'Retrieve essential variables from state bag
	intTotalQuestion = ViewState("TotalQuestion")
	intQuestionNo = ViewState("QuestionNo")
	intScore = ViewState("Score")
	arrAnswerHistory = ViewState("AnswerHistory")

	'Correct answer?
	If rblAnswer.SelectedItem.Value = ViewState("CorrectAnswer") Then
		intScore += 1
		arrAnswerHistory.Add(0)
	Else
		arrAnswerHistory.Add(rblAnswer.SelectedItem.Value)
	End If

	'End of quiz?
	If intQuestionNo=intTotalQuestion Then

		'Yes! Show the result...
		QuizScreen.Visible = False
		ResultScreen.Visible = True

		'Render result screen
		ShowResult()

	Else

		'Not yet! Show another question...
		QuizScreen.Visible = True
		ResultScreen.Visible = False
		intQuestionNo += 1
	
		'Render next question
		ShowQuestion(intQuestionNo)
	End If
End Sub


Sub ShowQuestion(intQuestionNo as Integer)
	Dim strXPath as String
	Dim intLoop as Integer
	Dim objTimeSpent as TimeSpan

	strXPath = "/quiz/mchoice[" & intQuestionNo.ToString() & "]"

	'Extract question
	xNodeIterator = xNav.Select(strXPath & "/question")
	xNodeIterator.MoveNext()
	lblQuestion.Text = intQuestionNo.ToString() & ". " & xNodeIterator.Current.Value

	'Extract answers
	xNodeIterator = xNav.Select(strXPath & "/answer")

	'Clear previous listitems
	rblAnswer.Items.Clear

	intLoop = 0
	While xNodeIterator.MoveNext()
	
		intLoop += 1

		'Add item to radiobuttonlist
		rblAnswer.Items.Add(new ListItem(xNodeIterator.Current.Value, intLoop))

		'Extract correct answer
		If xNodeIterator.Current.GetAttribute("correct","") = "yes" Then
			ViewState("CorrectAnswer") = intLoop
		End If

	End While

	'Output Total Question
	lblTotalQuestion.Text = intTotalQuestion

	'Output Time Spent
	objTimeSpent = DateTime.Now.Subtract(ViewState("StartTime"))
	lblTimeSpent.Text = objTimeSpent.Minutes.ToString() & ":" & objTimeSpent.Seconds.ToString()

	'Store essential data to state bag
	ViewState("TotalQuestion") = intTotalQuestion
	ViewState("Score") = intScore
	ViewState("QuestionNo") = intQuestionNo
	ViewState("AnswerHistory") = arrAnswerHistory

End Sub

Sub ShowResult()
	Dim strResult as String
	Dim intCompetency as Integer
	Dim intLoop as Integer
	Dim strXPath as String
	Dim objTimeSpent as TimeSpan
	
	objTimeSpent = DateTime.Now.Subtract(ViewState("StartTime"))

	strResult  = "<center>"
	strResult += "<h3>Quiz Result</h3>"
	strResult += "<p>Points: " & intScore.ToString() & " of " & intTotalQuestion.ToString()
	strResult += "<p>Your Competency: " & int(intScore/intTotalQuestion*100).ToString() & "%"
	strResult += "<p>Time Spent: " & objTimeSpent.Minutes.ToString() & ":" & objTimeSpent.Seconds.ToString()
	strResult += "</center>"

	strResult += "<h3>Quiz Breakdown:</h3>"
	For intLoop = 1 to intTotalQuestion
		strXPath = "/quiz/mchoice[" & intLoop.ToString() & "]"
		xNodeIterator = xNav.Select(strXPath & "/question")
		xNodeIterator.MoveNext()
		strResult += "<b>" & intLoop.ToString() & ". " & xNodeIterator.Current.Value & "</b><br>"
		If arrAnswerHistory.Item(intLoop-1)=0 Then
			strResult += "<font color=""green""><b>Correct</b></font><br><br>"
		Else
			xNodeIterator = xNav.Select(strXPath & "/answer[" & arrAnswerHistory.Item(intLoop-1).ToString() & "]")
			xNodeIterator.MoveNext()
			strResult += "<b>You answered:</b> " & xNodeIterator.Current.Value & "<br>"
			strResult += "<font color=""red""><b>Incorrect</b></font><br><br>"
		End If
	Next

	lblResult.Text = strResult
End Sub

</script>
<html>
<head>
<title>Australian Geography Quiz</title>
</head>

<style>
body {
  font-size: 10pt;
  font-family: verdana,helvetica,arial,sans-serif;
  color:#000000;
  background-color:#eeeedd;
}

tr.heading {
  background-color:#900B08;
}

.button {
	border: 1px solid #000000;
	background-color: #ffffff;
}

</style>

<body>
<span id="QuizScreen" runat="server">
<form runat="server">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr class="heading">
    <td width="50%"><font color="white"><b>Australian Geography Quiz</b></font></td>
	<td width="50%" align="right"><font color="white"><b>www.codeproject.com</b></font></td>
  </tr>
  <tr>
    <td colspan="2">
	  <b><asp:label id="lblQuestion" runat="server" /></b><br>
      <asp:radiobuttonlist
	     id="rblAnswer"
		 RepeatDirection="vertical"
		 TextAlign="right"
		 RepeatLayout="table"
		 runat="server" /><br>
	  <asp:requiredfieldvalidator
		 ControlToValidate="rblAnswer"
		 ErrorMessage="Please pick an answer!"
		 runat="server" /><br>
      <asp:button id="btnSubmit" class="button" text="  Next  " onClick="btnSubmit_Click" runat="server" />
	</td>
  </tr>
  <tr class="heading">
    <td width="50%"><font color="white"><b>Total <asp:label id="lblTotalQuestion" runat="server" /> questions</b></font></td>
	<td width="50%" align="right"><font color="white"><b>Time spent <asp:label id="lblTimeSpent" runat="server" /></b></font></td>
  </tr>
</table>
</form>
</span>
<span id="ResultScreen" runat="server">
<asp:label id="lblResult" runat="server" />
</span>
</body>
</html>
