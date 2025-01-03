import './bootstrap';
import Alpine from 'alpinejs';
import Quill from 'quill';
import 'quill/dist/quill.snow.css';

// Define Quill setup before Alpine initialization
window.setupQuill = function() {
    return {
        editor: null,
        content: '',

        init() {
            console.log('Initializing Quill...');
            this.$nextTick(() => {
                console.log('Inside nextTick...');
                try {
                    // Initialize Quill with default toolbar
                    this.editor = new Quill(this.$refs.quillEditor, {
                        modules: {
                            toolbar: [
                                ['bold', 'italic', 'underline', 'strike'],
                                [{ 'header': [1, 2, false] }],
                                ['clean'],
                                ['link', 'image', 'video']
                            ]
                        },
                        theme: 'snow',
                        placeholder: 'Write something amazing...'
                    });

                    // Set initial content if exists
                    if (this.content) {
                        this.editor.root.innerHTML = this.content;
                    }

                    // Update Livewire content when editor changes
                    this.editor.on('text-change', () => {
                        console.log('Text changed');
                        this.content = this.editor.root.innerHTML; // Update local content
                        // Ensure that the content is properly formatted for Livewire
                        if (this.$wire) {
                            console.log('Setting content in Livewire');
                            this.$wire.set('content', this.content);
                        }
                    });

                    console.log('Quill initialized successfully');
                } catch (error) {
                    console.error('Error initializing Quill:', error);
                }
            });
        }
    }
}

// Make sure Alpine is only initialized once
if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}

// Load dark mode asynchronously
import('./dark-mode').then(module => {
    requestAnimationFrame(() => {
        module.initDarkMode();
    });
});