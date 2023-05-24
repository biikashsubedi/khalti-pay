<script>
    var editors = document.querySelectorAll('.emailEditor')
    for (i = 0; i < editors.length; i++) {
        ClassicEditor.create(document.querySelectorAll('.emailEditor')[i])
            .then(editor => {
                editor.ui.view.editable.element.style.height = {{$height ?? 600}};
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>
