import {SingletonPopup} from "./singleton-popup";
import {FormPopup} from "./form-popup";

export class VideoPopup extends FormPopup {

  protected fields: any[] = [
    { type: 'text', name: 'code', label: 'Code' },
    { type: 'button', label: 'Apply', onclick: () => this.hide(), ignore: true }
  ];

}