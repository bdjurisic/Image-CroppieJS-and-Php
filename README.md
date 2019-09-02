# Image-CroppieJS-and-Php
Image crappie JS and PHP Script


## About

Uploading image with JS and PHP with crop feature.



# Image-CroppieJS-and-Php

Image crappie JS and PHP Script


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

You will need PHP up and runing and jquery, also permitions on uploads folder for read and write


### Installing

Styling 
```
    <link rel="stylesheet" href="croppie.css"/>
```

JS Files 

```
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="croppie.min.js"></script>
    <script src="crop_handler.js"></script>
```

End with an example of getting some data out of the system or using it for a little demo

## Running the tests

Change 

```
initImageCrop(
            $('#imagePreviewModal'),   <--- Modal
            $('#imageUpload'),         <--- Image Upload field in form
            $('#croppedImageData'),    <--- Hiden field form coordinats 
            {width: 400, height: 400}, <--- Width and Height of crop window
            {width: 480, height: 480}  <--- Modal Image Windows dimensions 
        )
```


## Built With

* [jQuery](https://code.jquery.com) - jQuery
* [Croppie](https://foliotek.github.io/Croppie/) - Croppie JS for croping


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
