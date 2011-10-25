/*******************************************************************************
**
** Filename:  SCODataManager.java
**
** File Description:  This class is responsible for maintaining the Data
**           Model content and structure.  An SCO Data Manager is created
**           with each initialization of an SCO.  The SCO Data Manager is
**           responsible for any interactions the LMS ,student, or SCO may
**           have with the Data Model.
**
** Author: ADLI Technical Team
**
** Company Name: Concurrent Technologies Corporation
**
** Module/Package Name: org.adl.datamodel.cmi
** Module/Package Description: Collection of CMI Data Model objects
**
** Design Issues:
**        In order to use Reflection (Java API) the defined Java
**        coding standards are NOT being followed.  Reflection requires
**        field names to match identically to input parameter.  The
**        attribute names match what is expected from a LMSGetValue()
**        or LMSSetValue() request.  Also the attribute values are declared
**        as public scope in order to use reflection.
**
** Implementation Issues:  The CMI_VERSION static attribute is set to
**                         version 3.4, this is the current version of
**                         the AICC CMI Data Model.  If the version is
**                         changed, this static attribute should be changed
**                         accordingly.
**
**                         The DM_CLASSNAME static attribute is set to
**                         the fully qualified (package) name for the
**                         data model classes.  The CMI added to the end
**                         of the string is the prefix to all of the Data
**                         Model classes.
**
** Known Problems:
** Side Effects:
**
** References: AICC CMI Data Model
**             ADL SCORM
**
*******************************************************************************
**
** Concurrent Technologies Corporation (CTC) grants you ("Licensee") a non-
** exclusive, royalty free, license to use, modify and redistribute this
** software in source and binary code form, provided that i) this copyright
** notice and license appear on all copies of the software; and ii) Licensee
** does not utilize the software in a manner which is disparaging to CTC.
**
** This software is provided "AS IS," without a warranty of any kind.  ALL
** EXPRESS OR IMPLIED CONDITIONS, REPRESENTATIONS AND WARRANTIES, INCLUDING ANY
** IMPLIED WARRANTY OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE OR NON-
** INFRINGEMENT, ARE HEREBY EXCLUDED.  CTC AND ITS LICENSORS SHALL NOT BE LIABLE
** FOR ANY DAMAGES SUFFERED BY LICENSEE AS A RESULT OF USING, MODIFYING OR
** DISTRIBUTING THE SOFTWARE OR ITS DERIVATIVES.  IN NO EVENT WILL CTC  OR ITS
** LICENSORS BE LIABLE FOR ANY LOST REVENUE, PROFIT OR DATA, OR FOR DIRECT,
** INDIRECT, SPECIAL, CONSEQUENTIAL, INCIDENTAL OR PUNITIVE DAMAGES, HOWEVER
** CAUSED AND REGARDLESS OF THE THEORY OF LIABILITY, ARISING OUT OF THE USE OF
** OR INABILITY TO USE SOFTWARE, EVEN IF CTC HAS BEEN ADVISED OF THE POSSIBILITY
** OF SUCH DAMAGES.
**
*******************************************************************************
**
** Date Changed   Author of Change  Reason for Changes
** ------------   ----------------  -------------------------------------------
** 11/07/2000     ADLI Project      PT - 264: References to "evaluation",
**                                  "paths", and "student_demographics" were
**                                  removed to reflect SCORM 1.1 changes.
**
** 11/15/2000     S.Thropp          PT-290: Added support for new
**                                  cmi.comments_from_lms.
**
** 01/12/2001     S.Thropp          PT-377: Changed all occurrences of AU/au
**                                  to SCO/sco.
**
*******************************************************************************/
package org.adl.datamodels;

//native java imports
import java.io.*;
import java.util.*;
import java.lang.reflect.*;

//adl imports
import org.adl.util.debug.*;
import org.adl.datamodels.cmi.*;

public class SCODataManager implements Serializable
{
   // Information required to be furnished by all LMS Systems.  What
   // all SCOs may depend on upon start up
   public CMICore core;
   // Unique information generated by the SCO during
   // previous uses, that is needed for the current use
   public CMISuspendData suspend_data;

   // Unique information generated at the SCO's creation
   // that is needed for every use.
   public CMILaunchData launch_data;

   // Comments (from the SCO or Student) about the SCO
   public CMIComments comments;

   // Comments (from the LMS or Instructor) about the SCO
   public CMICommentsFromLms comments_from_lms;

   // Identifies how the student has performed on individual objectives
   // covered by the SCO.
   public CMIObjectives objectives;

   // A recognizable and recordable input or group of inputs from the student
   // to the computer
   public CMIInteractions interactions;

   // Information to support customization of an SCO based
   // on a student's performance
   public CMIStudentData student_data;

   // Student selected options that are appropriate for subsequent
   // SCOs.
   public CMIStudentPreference student_preference;

   // The current working Base Category.  This could change with each request
   // from an SCO
   private String workingBaseCategory;

   private static final String CMI_VERSION = "3.4";
   private static final String DM_CLASSNAME = "org.adl.datamodels.cmi.CMI";

   //***************************************
   //**  Accessors to the SCODataManager Data
   //***************************************
   public CMICore getCore()
   {
      return core;
   }
   public CMISuspendData getSuspendData()
   {
      return suspend_data;
   }
   public CMILaunchData getLaunchData()
   {
      return launch_data;
   }
   public CMIComments getComments()
   {
      return comments;
   }

   public CMICommentsFromLms getCommentsFromLMS()
   {
      return comments_from_lms;
   }

   public CMIObjectives getObjectives()
   {
      return objectives;
   }

   public CMIInteractions getInteractions()
   {
      return interactions;
   }
   public CMIStudentData getStudentData()
   {
      return student_data;
   }

   public CMIStudentPreference getStudentPreference()
   {
      return student_preference;
   }

   //****************************************
   //**  Modifiers to the SCODataManager Data
   //****************************************
   public void setCore(CMICore inCore)
   {
      core = inCore;
   }
   public void setSuspendData(CMISuspendData inSuspendData)
   {
      suspend_data = inSuspendData;
   }
   public void setLaunchData(CMILaunchData inLaunchData)
   {
      launch_data = inLaunchData;
   }
   public void setComments(CMIComments inComments)
   {
      comments = inComments;
   }
   public void setCommentsFromLMS(CMICommentsFromLms inComments)
   {
      comments_from_lms = inComments;
   }
   public void setObjectives(CMIObjectives inObjectives)
   {
      objectives = inObjectives;
   }
   public void setInteractions(CMIInteractions inInteractions)
   {
      interactions = inInteractions;
   }
   public void setStudentData(CMIStudentData inStudentData)
   {
      student_data = inStudentData;
   }
   public void setStudentPreference(CMIStudentPreference inStudentPref)
   {
      student_preference = inStudentPref;
   }

   /****************************************************************************
    **
    ** Method:  SCODataManager
    ** Input:   none
    ** Output:  none
    **
    ** Description:  Default Constructor
    **
    ***************************************************************************/
   public SCODataManager()
   {
      core = new CMICore();
      suspend_data = new CMISuspendData();
      launch_data = new CMILaunchData();
      comments = new CMIComments();
      comments_from_lms = new CMICommentsFromLms();
      objectives = new CMIObjectives();
      interactions = new CMIInteractions();
      student_data = new CMIStudentData();
      student_preference = new CMIStudentPreference();

   } // end of default constructor

   /***************************************************************************
   **
   ** Method:  getValue
   ** Input:   CMIRequest theRequest - the current LMSGetValue() request
   **                                  being processed
   **          DMErrorManager dmErrorMgr - instance of the Data Model Error
   **                                      manager
   **
   ** Output:  String - the value of the category requested in the CMI Request
   **
   ** Description:  This method begins the processing of the LMSGetValue()
   **               request.  The method invokes the private method
   **               processRequest() and returns a string value representing
   **               the requested element
   **
   ***************************************************************************/
   public String getValue(CMIRequest theRequest,
                          DMErrorManager dmErrorMgr)
   {
      if (DebugIndicator.ON)
      {
          System.out.println("In SCODataManager::getValue");
      }

      // determine the base category
      workingBaseCategory = theRequest.getBaseCategory();

      String result = new String("");

      if ( workingBaseCategory.equals("_version") )
      {
         // set the result to the current version of the CMI Data Model
         result = CMI_VERSION;
      }
      else
      {
         result = processRequest(theRequest,dmErrorMgr);
      }

      return result;
   }

   /***************************************************************************
    **
    ** Method:  setValue
    ** Input:   CMIRequest theRequest - the current LMSSetValue() request
    **                                  being processed
    **          DMErrorManager dmErrorMgr - instance of the Data Model
    **                                      error manager
    **
    ** Output:  none
    **
    ** Description:  This method begins the processing of the LMSSetValue()
    **               request.  The method invokes the private method
    **               processRequest().
    **
    ***************************************************************************/
   public void setValue(CMIRequest theRequest,
                        DMErrorManager dmErrorMgr)
   {
      if (DebugIndicator.ON)
      {
         System.out.println("In SCODataManager::setValue");
      }
      // determine the base category
      workingBaseCategory = theRequest.getBaseCategory();
      String result = processRequest(theRequest,dmErrorMgr);
      return;
   }

   /***************************************************************************
   **
   ** Method:  processRequest
   ** Input:   CMIRequest theRequest - the current request being processed
   **          DMErrorManager dmErrorMgr - instance of the Data Model
   **                                      error manager
   **
   ** Output: String - result - For an LMSGetValue() request the result is
   **                           the value matching the element requested
   **                           For an LMSSetValue() request the result is
   **                           an empty string
   **
   ** Description:  This method processes both types of request from
   **               an SCO (LMSGetValue() and LMSSetValue()).  The method
   **               uses the Java Reflection API to determine the
   **               appropriate method to invoke and which class to invoke
   **               the method on.
   **
   ***************************************************************************/
   private String processRequest(CMIRequest theRequest,
                                 DMErrorManager dmErrorMgr)
   {

      // Result to be returned
      String result = new String("");

      // takes the base category and returns the class name
      // (i.e. student_data --> CMIStudentData
      String tmpClassName = convertString(workingBaseCategory);
      String className = DM_CLASSNAME + tmpClassName;

      if ( DebugIndicator.ON )
      {
         System.out.println("Class Name: " + className);
         System.out.println("Working Base Cat: " + workingBaseCategory);
      }

      try
      {
         // Find out the Class of the request
         Class c = Class.forName(className);
         try
         {
            // Find the field in the SCODataManager that maps
            // to the baseCategory
            Field tmpField = this.getClass().getField(workingBaseCategory);

            // Set up the array of Class objects
            // Each element in the array corresponds to a
            // parameter of the method you want to invoke
            Class[] parameterTypes =
               new Class[] {theRequest.getClass(), dmErrorMgr.getClass()};

            // Declare a variable to hold the method
            Method theMethod;

            // Declare an arry of objects for the arguments to the method
            Object[] arguments = new Object[] {theRequest,dmErrorMgr};
            try
            {
               // Determine the request type
               if ( theRequest.isForASetRequest() )
               {
                  // Find the method on Class c that is represented by the
                  // name of the method ("performSet") and the parameter
                  // types
                  theMethod = c.getMethod("performSet", parameterTypes);

                  // Invoke the method that was found matching the method name
                  // and parameter types
                  theMethod.invoke(tmpField.get(this),arguments);
               }
               else
               {
                  theMethod = c.getMethod("performGet",parameterTypes);
                  // Invoke the method that was found matching the method name
                  // and parameter types
                  result =
                     (String) theMethod.invoke(tmpField.get(this),arguments);
               }
            }
            catch ( NoSuchMethodException e )
            {
               System.out.println(e);
            }
            catch ( IllegalAccessException e )
            {
               System.out.println(e);
            }
            catch ( InvocationTargetException e )
            {
               System.out.println(e);
            }
         }
         catch ( NoSuchFieldException nsfe )
         {
            if (DebugIndicator.ON)
            {
               System.out.println(nsfe);
               System.out.println("Error - Data Model Element not Implemented");
            }
            dmErrorMgr.recNotImplementedError(theRequest);
         }
      }
      catch ( ClassNotFoundException cnfe )
      {
         if (DebugIndicator.ON)
         {
            System.out.println(cnfe);
            System.out.println("Error - Data Model Element not implemented");
         }
         dmErrorMgr.recNotImplementedError(theRequest);
      }

      return result;
   }  // end of setValue()


   /***************************************************************************
    **
    ** Method:  convertString
    ** Input:   String theString - the string that needs converted
    **                             (i.e. core, student_data).
    **
    ** Output:  String result - the converted string
    **                          (i.e. Core, StudentData)
    **
    ** Description:  The method takes the input string and converts it
    **               to the appropriate format.  The format is a capital
    **               letter followed by the rest of the word, where every
    **               other word is capitalized.
    **
    **               student_data -->  StudentData
    **               core -->  Core
    ***************************************************************************/
   private String convertString(String theString)
   {
      // Tokenize the base category, using the _ as a separator
      StringTokenizer stk = new StringTokenizer(theString, "_", false);

      // Count the total number of tokens
      int total = stk.countTokens();

      // String to hold result
      String result = new String("");

      while ( stk.hasMoreTokens() )
      {
         // Invoke the fixWord() method to capitalize the first letter
         // and build the rest of the class name
         result = result.concat( fixWord( stk.nextToken() ) );
      }

      return result;
   }  // end of convertString()

   /***************************************************************************
   **
   ** Method:  fixWord
   ** Input:   Strng wordToFix - The word that needs changed into
   **                            a word meeting our standards
   **
   ** Output:  String result - The standardized word
   **
   ** Description:  This method is responsible for standardize the
   **               input argument.  Standardizing means take the first
   **               letter and capitalizing it and then returning
   **               the word.
   **
   **               (i.e. -  student --> Student
   ***************************************************************************/
   private String fixWord(String wordToFix)
   {
      // declare a result string
      String result = new String("");

      // Strip off the first letter
      String firstLetter = wordToFix.substring(0,1);

      // save the last part of the word (minus the first letter)
      String restOfWord = wordToFix.substring(1);

      // Change the first letter to upper case
      String ucFirstLetter = firstLetter.toUpperCase();

      // Concatenate the first letter with the rest of the word
      result = ucFirstLetter.concat(restOfWord);

      // Return the result
      return result;

   }  // end of fixWord()

}  // end of SCODataManager