<div x-data="{ content: @entangle($attributes->wire('model')) }" x-ref="quillEditor" x-init="function setupEditor() {
    const quill = new Quill($refs.quillEditor, {
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'font': [] }],
                [{ 'align': [] }],
                ['clean'],
                ['link', 'image', 'video', 'formula']
            ],
            history: {
                delay: 2000,
                maxStack: 500,
                userOnly: true
            },
            table: true
        },
        placeholder: '{{ __('Write something...') }}',
        theme: 'snow',
        bounds: document.body,
        debug: 'warn'
    });

    // Log the initial content for debugging
    console.log('Initial content:', this.content); // Before setting to Quill

    // Set initial content if exists
    if (this.content) {
        quill.root.innerHTML = this.content; // Set initial content
        console.log('Content set in Quill:', this.content); // After setting to Quill
    }

    quill.on('text-change', function() {
        this.content = quill.root.innerHTML; // Update local content
        $dispatch('input', this.content); // Dispatch input event
    }.bind(this));
}"></div>
