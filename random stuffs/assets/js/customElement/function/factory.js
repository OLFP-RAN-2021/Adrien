/**
 * Create a custom element
 *
 * @param {string} tagname : the tag name. Ex : my-cutom-tag
 * @param {HTMLElement} parent : get element parent prototype. Default : HTMLElement.
 * @param {string} children : do heritence to target.
 * @param {bool} get : return instance of Element
 * @returns {object|null}
 */
function factory(
    tagname = "custom-obj",
    events = null,
    parent = null,
    children = null,
    get = true
) {
    parent = parent ?? HTMLElement;

    window[tagname] = class extends parent {
        constructor() {
            super();
        }
    };

    if (children != null && typeof children == "string")
        customElements.define(tagname, window[tagname], {
            extends: children,
        });
    else customElements.define(tagname, window[tagname]);

    if (get === true) {
        let instance = new window[tagname]();

        if (events != null && events.length > 0)
            for (const event of events) {
                instance.addEventListener(event.event, (e) => {
                    event.callable(e);
                });
            }
        return instance;
    }
}