import {FormPopup} from "./form-popup";

export class LinkSettingsPopup extends FormPopup {

  protected fields: any[] = [
    { type: 'text', name: 'href', label: 'Href' },
    { type: 'text', name: 'title', label: 'Title' },
    { type: 'text', name: 'value', label: 'Value' },
    { type: 'button', label: 'Apply', onclick: () => this.hide(), ignore: true }
  ];

}