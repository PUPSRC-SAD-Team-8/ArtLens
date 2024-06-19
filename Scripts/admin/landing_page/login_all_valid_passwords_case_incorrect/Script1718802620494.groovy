import static com.kms.katalon.core.checkpoint.CheckpointFactory.findCheckpoint
import static com.kms.katalon.core.testcase.TestCaseFactory.findTestCase
import static com.kms.katalon.core.testdata.TestDataFactory.findTestData
import static com.kms.katalon.core.testobject.ObjectRepository.findTestObject
import static com.kms.katalon.core.testobject.ObjectRepository.findWindowsObject
import com.kms.katalon.core.checkpoint.Checkpoint as Checkpoint
import com.kms.katalon.core.cucumber.keyword.CucumberBuiltinKeywords as CucumberKW
import com.kms.katalon.core.mobile.keyword.MobileBuiltInKeywords as Mobile
import com.kms.katalon.core.model.FailureHandling as FailureHandling
import com.kms.katalon.core.testcase.TestCase as TestCase
import com.kms.katalon.core.testdata.TestData as TestData
import com.kms.katalon.core.testng.keyword.TestNGBuiltinKeywords as TestNGKW
import com.kms.katalon.core.testobject.TestObject as TestObject
import com.kms.katalon.core.webservice.keyword.WSBuiltInKeywords as WS
import com.kms.katalon.core.webui.keyword.WebUiBuiltInKeywords as WebUI
import com.kms.katalon.core.windows.keyword.WindowsBuiltinKeywords as Windows
import internal.GlobalVariable as GlobalVariable
import org.openqa.selenium.Keys as Keys
import com.kms.katalon.core.util.KeywordUtil as KeywordUtil
import com.artlens.utils.AdminUtils as AdminUtils
import java.util.Random


try {
	
	Number userIndex = GlobalVariable.userIndex
	
	WebUI.callTestCase(findTestCase('admin/landing_page/header_bar_visible'), [:], FailureHandling.STOP_ON_FAILURE)
	
	String password = GlobalVariable.ValidPasswordCredentials[userIndex]
	
	char[] passwordChars = password.toCharArray()
	
	boolean caseChanged = false
	
	// Loop through each character and change the case of alphabetic characters
	for (int i = 0; i < passwordChars.length; i++) {
	    char currentChar = passwordChars[i]
	    if (Character.isLetter(currentChar)) { // Check if character is alphabetic
	        if (Character.isUpperCase(currentChar)) {
	            passwordChars[i] = Character.toLowerCase(currentChar)
	            caseChanged = true
	            break // Exit loop once a change is made
	        } else if (Character.isLowerCase(currentChar)) {
	            passwordChars[i] = Character.toUpperCase(currentChar)
	            caseChanged = true
	            break // Exit loop once a change is made
	        }
	    }
	}
	
	// If no alphabetic character's case has been changed
	if (!caseChanged && passwordChars.length > 0) {
		KeywordUtil.markPassed('The test case itself fail incorrect test data ')
	}
	
	password = new String(passwordChars)
	
	KeywordUtil.logInfo("Modified Password: " + password)
	
	// Perform admin login using the original email and the modified password
	AdminUtils.adminLogin(GlobalVariable.ValidUsernameCredentials[userIndex], password)

	
	String currentUrl = WebUI.getUrl()
	
	String expectedUrl = "${GlobalVariable.appBaseLink}admin.php"

	boolean isUrlCorrect = WebUI.verifyMatch(currentUrl, expectedUrl, false)

	if (isUrlCorrect) {
		KeywordUtil.markPassed('The URL is correct: ' + currentUrl)
	} else {
		KeywordUtil.markFailed((('The URL is incorrect. Expected: ' + expectedUrl) + ' but got: ') + currentUrl)
	}
	
}
catch (Exception e) {
	KeywordUtil.markFailed('An error occurred: ' + e.message)
}
finally {
//	WebUI.closeBrowser()
}

