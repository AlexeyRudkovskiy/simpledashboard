import {AbstractAction} from "./abstract-action";
import {SimpleAction} from "./simple-action";

export class ActionTextAlignRight extends SimpleAction {

  protected commandName: string = 'JustifyRight';

  getDescription(): string {
    return "Text align right";
  }

  getIcon(): string {
    return "fa fa-align-right";
  }

  getName(): string {
    return "toolbar.text_align.right";
  }

}