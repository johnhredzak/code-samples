function getAddresses() {
// Get addresses from spreadsheet named "Form Submit Recipients"
  var addressObj = {};
  var ss = SpreadsheetApp.openById('1QiOV4zZBti41-NdCQcPFtAPDYcvrPYf9GYJFsHazzzz');
  var sheet = ss.getSheetByName('Form Submit Recipients');
  var data = sheet.getDataRange().getValues();
  for (var i = 1; i < data.length; i++) {   // skipping header row
    addressObj[data[i][0]] = data[i][1];
  }
  return addressObj;
}

function sendContactMessage(e) {
// This function is triggered on Form Submit by the website visitor
// (Trigger set up from account: cacpittsburgh; cannot be changed from any other account)

  // Get addresses for recipients
  var adr = getAddresses();

  // NOTE: Use of the following assignments requires that "Allow responders to edit responses after submitting" be UNCHECKED in the form.

  // Assign contents of form submission
  var sentTime = e.values[0];
  var msgTopic = e.values[1];
  var submitterName = e.values[2];
  var submitterEmail = e.values[3];
  var submitterPhone = e.values[4];
  var contactRequest = e.values[5];
  var submitterSubject = e.values[6];
  var submitterMessage = e.values[7];
  
  if (contactRequest == '')
    contactRequest = '(not requested)';
  
  // Declaration
  var receiveEmail;  // contact message recipient;

  // Determine the respective recipient
  switch (msgTopic) {
    case 'New to CAC' : receiveEmail = adr.membership;
      break;
    case 'Softball' : receiveEmail = adr.softball;
      break;
    case 'Tennis' : receiveEmail = adr.tennis;
      break;
    case 'Volleyball' : receiveEmail = adr.volleyball;
      break;
    case 'Report an issue' : receiveEmail = adr.membership + ',' + adr.newsletter + ',' + adr.website;
      break;
    case 'Alumni Affairs' : receiveEmail = adr.alumni;
      break;
    case 'Contact leadership' : receiveEmail = adr.president;
      break;
    case 'Other' : receiveEmail = adr.president;
      break;
    default : receiveEmail = missingCase + ',' + adr.president;
  }
  
  // Define subjects for both recipient and submitter return
  var receiveSubject = '[CAC-Web] ' + submitterSubject;
  var returnSubject = 'Confirmation of your message to CAC of Pittsburgh';

  // Define message preface for both recipient and submitter return
  var receiveBodyPreface = 'This message has been sent through the CAC website\n';
  var returnBodyPreface = 'Thank you for your message to CAC of Pittsburgh. ' +
    'If you have requested contact from us, we will get back to you accordingly.\n\n' +
    'Please do not reply to this message (it will go nowhere).\n\n' +
    '----- Here is a copy of what you sent: -----\n';

  var bodyMain =
    '\nTopic:   ' + msgTopic + '\n' +
    '\nSent:    ' + sentTime +
    '\nFrom:    ' + submitterName +
    '\nE-mail:  ' + submitterEmail +
    '\nPhone:   ' + submitterPhone +
    '\nContact? ' + contactRequest +
    '\n\nSubject: ' + submitterSubject +
    '\n\n--- Message: ---\n\n' + submitterMessage;

  // Send to respective recipient
  MailApp.sendEmail({
    to: receiveEmail,
    cc: adr.ccForDuplicate,
    subject: receiveSubject,
    body: receiveBodyPreface + bodyMain,
    name: submitterName,
    replyTo: submitterName + ' <' + submitterEmail + '>'
  });

  // Send confirmation message to submitter
  MailApp.sendEmail({
    to: submitterName + ' <' + submitterEmail + '>',
    subject: returnSubject,
    body: returnBodyPreface + bodyMain,
    name: 'CAC Auto-reply',
    replyTo: 'NONE'
  });

}