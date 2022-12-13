import 'bootstrap';
import 'livewire-sortable';
import './editor';

window.editTitle = function editTitle(el) {
    let input = document.createElement("input");
    input.value = el.innerText;

    el.parentNode.replaceChild(input, el);
    input.focus();

    input.addEventListener("keyup", (e) => {
        if (e.key === "Enter") save();
        if (e.key === "Escape") discard();
    });

    input.addEventListener("focusout", () => {
        save();
    });

    const save = () => {
        const item = input.closest("[wire\\:id]");
        const itemId = item.getAttribute("data-id");

        if (el.innerText !== input.value) {
            Livewire.emit("updateItem", itemId, {"title": input.value});
        }

        el.innerText = input.value;
        discard();
    }

    const discard = () => {
        input.parentNode.replaceChild(el, input);
        input.blur();
    }
}
