import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
  dictDefaultMessage: 'Upload your image',
  acceptedFiles: '.png,.jpg,.jpeg,.gif',
  addRemoveLinks: true,
  dictRemoveFile: 'Remove the image',
  maxFiles: 1,
  uploadMultiple: false,

  init: function() {
    const image = document.getElementById('image');

    if(image.value.trim()) {
      const prevImage = {};
      prevImage.size = image.dataset.size;
      prevImage.name = image.value;

      // dropzone specific methods:
      this.options.addedfile.call(this, prevImage);
      this.options.thumbnail.call(this, prevImage, `/uploads/${prevImage.name}`);

      prevImage.previewElement.classList.add('dz-success', 'dz-complete');
    }
  }
});

dropzone.on('sending', function(file, xhr, formData) {
  console.log(file);
});

dropzone.on('success', function(file, response) {
  console.log(response);
  const image = document.getElementById('image');
  image.value = response.image;
  image.dataset.size = file.size;
});

dropzone.on('error', function(file, message) {
  console.log(message);
});

dropzone.on('removedfile', function() {
  //console.log('file removed!');
  document.getElementById('image').value = '';
});