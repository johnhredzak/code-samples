// Call to serve the web page
function doGet() {
  return HtmlService.createHtmlOutputFromFile('index');
}

// Writes renewal application data for use by Wizy Mail Merge & Doc Merge add-on
// Data is for those whose membership expiration is the month specified
function renewalAppData(inpMonth1) {
  // Convert to zero-based month
  var inpMonth0 = +inpMonth1 - 1;
  // Active sheet: Members data table
  var ss = SpreadsheetApp.openById('1krO0mCdnhzahEFcCClBTqds07Yv6F31tFOzdC5wzzzz');
  var sheet = ss.getSheetByName('T_Members');
  var inData = sheet.getDataRange().getValues();
  // Initialize output array
  var outData = [];
  var outRow = 0;
  // Write header row of output
  outData[0] = inData[0];
  outData[0][21] = 'DocName';
  // Get current year and month
  var currentDate = new Date();
  var currentYear = currentDate.getFullYear();
  var currentMonth = currentDate.getMonth();
  // Year is based on input month, which shall be between range: 1) 2 months before now, and 2) 9 months after now
  var monthsDiff = inpMonth0 - currentMonth;
  var inpYear = currentYear + Math.floor((monthsDiff+2)/12);
  // Read all members data and record relevant data of those meeting criteria
  // Criteria: expiration month same as month selected
  for (var inRow = 1; inRow < inData.length; inRow++) {
    // Get expiration year and month for comparison
    var expMonthYear = new Date(inData[inRow][10]);
    var expYear = expMonthYear.getFullYear();
    var expMonth0 = expMonthYear.getMonth();
    // If matching year and month, append to data for app printing
    if ((inpYear == expYear) && (inpMonth0 == expMonth0)) {
      outRow++;
      var lastName = inData[inRow][0];
      var expMonth1 = expMonth0 + 1;
      var docName = 'Exp-' + expMonth1 + '-' + expYear + '-' +  lastName;
      var expPrint = expMonth1 + '/' + expYear;
      outData[outRow] = inData[inRow];
      outData[outRow][10] = expPrint;
      outData[outRow][21] = docName;
      //Logger.log(outData[outRow]);  // DEBUG
    }
  }
  // Active sheet: Renewal applications data table
  ss = SpreadsheetApp.openById('1zFtGJ14456dyTPXL_HDUVhpTKbl332ypgLaTtk3zzzz');
  sheet = ss.getSheetByName('Renewal Apps');
  sheet.clear();
  // Write data
  for (var outRow = 0; outRow < outData.length; outRow++) {
    sheet.appendRow(outData[outRow]);
  }
  return outData.length - 1;
}
