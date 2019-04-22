Dropzone.options.myAwesomeDropzone = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  acceptFiles: "image/*",
  accept: function(file, done) {
    if (file.name == "justinbieber.jpg") {
      done("Naha, you don't.");
    }
    else { done(); }
  }
};

var clipboard = new Clipboard('.copy');
clipboard.on('success', function(e) {
    e.action;
    alert('Url Copied Successfully');
});
