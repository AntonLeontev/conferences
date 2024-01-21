import Quill from "quill";
window.Quill = Quill;
import katex from "katex";
window.katex = katex;
window.quillToolbarOptions = {
    container: [
        [{ font: [] }],
        [{ size: ["small", "normal", "large", "huge"] }], // custom dropdown
        ["bold", "italic", "underline", "strike"], // toggled buttons
        [{ align: [] }],
        [{ list: "ordered" }, { list: "bullet" }],
        [{ script: "sub" }, { script: "super" }], // superscript/subscript
        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
        [({ color: [] }, { background: [] })], // dropdown with defaults from theme

        [{ symbol: ["α", "β", "π"] }],
        ["clean"],
    ],
    handlers: {
        symbol: function (value) {
            if (value) {
                const cursorPosition = this.quill.getSelection().index;
                this.quill.insertText(cursorPosition, value);
                this.quill.setSelection(cursorPosition + value.length);
            }
        },
    },
};
