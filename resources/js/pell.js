import { init } from 'pell';
import 'pell/dist/pell.css';

document.addEventListener('DOMContentLoaded', () => {
    // Find the textarea with the class 'pell-editor'
    const textarea = document.querySelector('.pell-editor');
    if (!textarea) {
        console.error('Textarea with class "pell-editor" not found.');
        return;
    }

    // Hide the textarea
    textarea.classList.add('hidden');

    // Create a div for the Pell editor
    const pellDiv = document.createElement('div');
    pellDiv.id = 'pell';
    textarea.parentNode.insertBefore(pellDiv, textarea);

    // Initialize Pell editor
    const editor = init({
        element: pellDiv,
        onChange: (html) => {
            textarea.value = html; // Update the hidden textarea with editor content
        },
        defaultParagraphSeparator: 'p',
        styleWithCSS: true,
        actions: [
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'heading1',
            'heading2',
            'olist',
            'ulist',
            'quote',
            'code',
            'line',
            'link',
            'image',
        ],
        classes: {
            actionbar: 'pell-actionbar',
            button: 'pell-button',
            content: 'pell-content',
            selected: 'pell-button-selected',
        },
    });

    pellDiv.classList.add(
        'rounded-md', 
        'border', 
        'border-gray-300', 
        'shadow-sm', 
        'focus:border-blue-500', 
        'focus:ring-blue-500', 
        'bg-white'
    );

    // Function to dynamically set the content of the editor
    window.setEditorContent = (content) => {
        editor.content.innerHTML = content || '<p>Start typing...</p>';
    };

    // Set initial content
    editor.content.innerHTML = '<p>Start typing...</p>';
});
