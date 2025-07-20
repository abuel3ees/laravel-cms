if (typeof CKEDITOR !== 'undefined') {
    if (CKEDITOR.instances.body) {
        CKEDITOR.instances.body.destroy(true);
    }
    CKEDITOR.replace('body');
}
