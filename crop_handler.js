function initImageCrop($modal, $fileField, $pointsField, viewport, boundary) {

    var cropCtx = {
        modalEl: $modal,
        fileEl: $fileField,
        pointsEl: $pointsField,
        viewport: viewport,
        boundary: boundary,
        previewEl: $modal.find('.crop_image_preview')
    };

    (function (ctx) {
        ctx.fileEl.on('change', function (evt) {
            console.log("FILE FIELD CHANGE: ", ctx.viewport, ctx.boundary);

            var file = evt.target.files[0];

            if (!file) {
                return;
            }

            refreshCrop();

            ctx.modalEl.modal('show')
                .on('hide.bs.modal', function () {
                    var c = ctx.previewEl.croppie('get')['points'];
                    ctx.pointsEl.val(c[0] + '/' + c[1] + '/' + c[2] + '/' + c[3]).trigger('change');
                });

            var reader = new FileReader();
            reader.onload = function (e) {
                console.log("FileReader on load!");
                var image = new Image();

                image.onload = function () {
                    ctx.previewEl.attr('src', e.target.result);
                    refreshCrop();
                };

                image.onerror = function () {
                    ctx.modalEl.modal('hide');
                    evt.target.value = "";
                    alert("Invalid photo.");
                };

                image.src = e.target.result;
            };

            reader.readAsDataURL(file);
        });

        function refreshCrop() {
            ctx.previewEl.croppie('destroy');
            initCrop();
        }

        function initCrop() {
            ctx.previewEl.croppie({
                viewport: ctx.viewport,
                boundary: ctx.boundary
            });
        }

        initCrop();

    }(cropCtx));
}