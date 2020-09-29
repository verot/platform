import {Controller} from 'stimulus';
import {Tooltip} from 'bootstrap'

export default class extends Controller {


    /**
     *
     */
    connect() {
        this.tooltip = new Tooltip(this.element, {
            trigger : 'manual',
        })
    }
    /**
     *
     */
    mouseOver() {
        this.tooltip.show();
    }

    /**
     *
     */
    mouseOut() {
        this.tooltip.hide();
    }
}
