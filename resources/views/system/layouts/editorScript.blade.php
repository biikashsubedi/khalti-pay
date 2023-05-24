<script>
    var editors = document.querySelectorAll('.editor')
    for (i = 0; i < editors.length; i++) {
        ClassicEditor.create(document.querySelectorAll('.editor')[i])
            .then(editor => {
                editor.ui.view.editable.element.style.height = {{$height}};
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>
