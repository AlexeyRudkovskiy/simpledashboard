import {SimpleAction} from "./simple-action";

export class ActionListIndent extends SimpleAction {

  protected commandName: string = 'indent';

  protected hotKey: string = this.composeHotKey(']');

  getDescription(): string {
    return "Indent list";
  }

  getIcon(): string {
    return "fa fa-indent";
  }

  getName(): string {
    return "toolbar.list.indent";
  }

}