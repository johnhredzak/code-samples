// AngularJS Application Code for CACI.org

// --- MODULE DECLARATION ---

var app = angular.module('caciApp', []);

// --- ROOT SCOPE ---

app.run(function($rootScope) {
   // Current date and year
   $rootScope.now = new Date();
   $rootScope.thisYear = $rootScope.now.getFullYear();
});

// --- DIRECTIVE ---

// contactButton - Renders button (with specified text) to open contact form (for specified recipient)
app.directive('contactButton', function() {
   return {
      restrict: 'E',
      replace: false,
      templateUrl: 'dir-contactbutton.html',
      scope: {
         recipient: '=',
         buttonText: '@'
      }
/*      template: function(elem, attr) {
         return '<button type="button" class="btn btn-default" ng-controller="contactFormPromptCtrl" ng-click="openModal('
           + attr.recipient + ')"><span class="glyphicon glyphicon-pencil"></span> ' + attr.buttonText + '</button>';
      }*/  // template has been replaced with templateUrl
   };
});

// --- SERVICE ---

// contactFormSvc - Service supporting the contact form and its modal
app.service('contactFormSvc', function() {
  this.contactFormRecipient = '';
  this.changeModalState = function(modalState) {
    if (modalState == 'show') {
      // open the modal, and disable ability to close it on click outside modal
      $('#contactModal').modal({
        backdrop: 'static'
      });
    }
    if (modalState == 'hide')
      $('#contactModal').modal('hide');
  };
});

// --- CONTROLLERS ---

// Officers/contact data
app.controller('contactDataCtrl', function($scope, $http, $filter) {
   $http({
      method: 'GET',
      url: 'getdata.php?dataset=contact',
      cache: true
   }).then(function(response) {
      // success
      $scope.contactData = response.data.contact;
      console.log('response = ');  // DEBUG
      console.log(response);  // DEBUG
      console.log('$scope.contactData = ');  // DEBUG
      console.log($scope.contactData);  // DEBUG
      if (angular.isDefined($scope.contactData)) {
         // Officers info
         $scope.officersList = $filter('filter')($scope.contactData, {type: "officer"}, true);
         // Display respective CACI official or year
         $scope.getPersonField = function(titleField) {
            var found = $filter('filter')($scope.contactData, {title: titleField}, true);
            if (angular.isDefined(found)) {
               console.log('found[0] = ');  // DEBUG
               console.log(found[0]);  // DEBUG
               return found[0].person;
            }
            else {
               return '';
            }
         }
     };
   });
   if (angular.isUndefined($scope.officersList)) {
       // error - Officers table will have one-line message, all others blank
       $scope.officersList = [{type: "officer", title: "Info not available"}];
   }  
});

// Local clubs data
app.controller('localclubsCtrl', function($scope, $http) {
   $http.get('getdata.php?dataset=localclubs').then(function(response) {
      $scope.localclubsList = response.data.localclubs;
   }, function() {
      $scope.localclubsList = [
        {club:"Info not available", region:"Western"},
        {club:"Info not available", region:"Midwest"},
        {club:"Info not available", region:"Eastern"}
      ];
   });
});

// Travel event data
app.controller('travelCtrl', function($scope, $http) {
   $http.get('getdata.php?dataset=travel').then(function(response) {
      $scope.travelList = response.data.travel;
   }, function() {
      $scope.travelList = [{date:"Info not available"}];
   });
});

// Newsletter issue data
app.controller('newsletterCtrl', function($scope, $http) {
   $http.get('getdata.php?dataset=newsletter').then(function(response) {
      $scope.newsletterList = response.data.newsletter;
   }, function() {
      $scope.newsletterList = [{issue:"Info not available"}];
   });
});

// Past conventions
app.controller('pastConvCtrl', function($scope, $http) {
   $http.get('getdata.php?dataset=pastConventions').then(function(response) {
      $scope.convList = response.data.pastConventions;
   }, function() {
      $scope.convList = [{year:"Info not available"}];
   });
});

// Form & brochure downloads
app.controller('downloadLinksCtrl', function($scope, $http) {
   var now = new Date();
   $scope.downloadYear = now.getFullYear();
   $http.get('getfilelist.php?year=' + $scope.downloadYear).then(function(response) {
      $scope.fileNames = response.data.fileList;
   }, function() {
      $scope.fileNames = ["Info not available"];
   });
});

// contactFormPromptCtrl - Controller for UI contact button
app.controller('contactFormPromptCtrl', function($scope, contactFormSvc) {
    $scope.openModal = function(recipient) {
      contactFormSvc.changeModalState('show');
      contactFormSvc.contactFormRecipient = recipient;
    };
});

// contactFormCtrl - Controller for contact form
app.controller('contactFormCtrl', function($scope, $http, contactFormSvc) {

   // Initialize
   $scope.contactFormData = {};
   $scope.responseData = {};  // DEBUG
   $scope.resultMessage = '';
   $scope.cancelButtonText = 'Cancel';
   $scope.submitSuccess = false;

   // contactFormRecipient() - For display in model and inclusion in object to be sent:
   $scope.contactFormRecipient = function() {
      return contactFormSvc.contactFormRecipient;
   };

   // closeModal() - Dismiss the modal and reset the from
   $scope.closeModal = function() {
      // Dismiss modal
      contactFormSvc.changeModalState('hide');
      // Re-initialize object & values, and reset validation states
      $scope.contactFormData = {};
      $scope.responseData = {};  // DEBUG
      $scope.resultMessage = '';
      $scope.cancelButtonText = 'Cancel';
      $scope.submitSuccess = false;
      $scope.contactForm.$setPristine();
      $scope.contactForm.$setUntouched();         
   };

   // sendFormData() - Send to server for processing, incl error check
   $scope.sendFormData = function(isValid) {
      if (isValid) {
         // Client-side validation passes
         // Add recipient to form data object
         $scope.contactFormData.recipient = $scope.contactFormRecipient();
         // Send form data to server
         $http({
            method: 'POST',
            url: 'sendmsg.php',
            data: $.param($scope.contactFormData),  // pass data as strings with jQuery $.param()
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // pass data as form data
         }).then(function(response) {
            // http success callback
            $scope.responseData = response.data;  // DEBUG
            $scope.resultMessage = response.data.message;
            $scope.submitSuccess = response.data.success;  // If true, send button becomes disabled
            if ($scope.submitSuccess) {
               // Form has been processed
               $scope.cancelButtonText = 'Close';
            }
            else if (!$scope.resultMessage) {
               $scope.resultMessage = 'Server error (PHP). Please try again, or later if problem persists.';
            }
         }, function(response) {
            // http failure callback
            $scope.resultMessage = 'Server error (' + response.status + '). Please try again, or later if problem persists.';
         });
      }
      else {
          // Validation fails (at client side)
          $scope.resultMessage = 'Please make corrections as noted above.';
      }
   };  // end $scope.sendFormData()

});  // end contactFormCtrl
