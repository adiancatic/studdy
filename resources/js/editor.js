import EditorJS from '@editorjs/editorjs';

document.addEventListener("livewire:load", () => {
    if (! document.querySelector("#editorjs")) return;

    const editor = new EditorJS({
        data: typeof item !== "undefined" ? JSON.parse(item.content) : {},
        onChange: debounce( () => {
            saveData();
        }, 2000),

    });

    const saveData = () => {
        editor
            .save()
            .then((data) => {
                Livewire.emit("updateItem", data);
            }).catch((error) => {
                console.log('Saving failed: ', error);
            });
    };
});

function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
        clearTimeout(timer);

        timer = setTimeout(() => {
            func.apply(this, ...args);
        }, timeout);
    }
}
