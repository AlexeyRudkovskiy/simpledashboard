import {AbstractAction} from "./abstract-action";
import {SimpleAction} from "./simple-action";

export class ActionTextAlignLeft extends SimpleAction {

  protected commandName: string = 'JustifyLeft';

  getDescription(): string {
    return "Text align left";
  }

  getIcon(): string {
    return "fa fa-align-left";
  }

  getName(): string {
    return "toolbar.text_align.left";
  }

}