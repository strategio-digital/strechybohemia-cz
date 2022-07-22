/**
 * Copyright (c) 2021 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

import {Button, Dropdown, Popover} from "bootstrap";

export default () => {
    Array.from(document.querySelectorAll('.btn')).forEach(node => new Button(node));
    Array.from(document.querySelectorAll('[data-bs-toggle="dropdown"]')).forEach(node => new Dropdown(node));
    Array.from(document.querySelectorAll('[data-bs-toggle="popover"]')).forEach((node => new Popover(node)))

    // Nepřidávat collapse - bug v sekci FAQ
    //Array.from(document.querySelectorAll('[data-bs-toggle="collapse"]')).forEach(node => new Collapse(node));
}