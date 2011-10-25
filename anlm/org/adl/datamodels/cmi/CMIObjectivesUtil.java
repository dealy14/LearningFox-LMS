/*******************************************************************************
**
** Filename:  CMIObjectivesUtil.java
**
** File Description:
**
** Author: ADLI Project
**
** Company Name: Concurrent Technologies Corporation
**
** Module/Package Name: org.adl.datamodel.cmi
** Module/Package Description: Collection of CMI Data Model objects
**
** Design Issues:
**
** Implementation Issues:
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
**
*******************************************************************************/
package org.adl.datamodels.cmi;

//native java imports
import java.io.*;

//adl imports
import org.adl.util.debug.*;
import org.adl.datamodels.*;

public class CMIObjectivesUtil extends CMICategory implements Serializable
{
   public CMIObjectiveData objectives;

   /****************************************************************************
    **
    ** Method:  Default constructor
    ** Input:   none
    ** Output:  none
    **
    ** Description: Default constructor
    **
    ***************************************************************************/
   public CMIObjectivesUtil()
   {
      super( true );

      objectives = new CMIObjectiveData();


   } // end of Default constructor

   /******************************************
    **  Accessors to the CMIObjectiveUtil Data.
    *******************************************/
   public CMIObjectiveData getObjectives()
   {
      return objectives;
   }

}  // end of CMIObjectivesUtil
