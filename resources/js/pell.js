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
            'line',
            'link',
            'image',
        ],
        classes: {
            actionbar: 'pell-actionbar bg-gray-100 border-b border-gray-300', // Tailwind for toolbar
            button: 'pell-button hover:bg-gray-200', // Tailwind for buttons
            content: 'pell-content p-2 text-gray-800 focus:outline-none', // Tailwind for content area
            selected: 'pell-button-selected bg-gray-300',
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
        editor.content.innerHTML = content || '';
    };

    // Set initial content
    editor.content.innerHTML = '';
});
