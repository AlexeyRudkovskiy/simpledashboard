import {AbstractAction} from "./abstract-action";

export class TableDeleteColumn extends AbstractAction {

  create() {
    this.anchor = document.createElement('a');
    this.anchor.href = 'javascript:';
    this.anchor.innerHTML = 'удалить колонку';
    this.anchor.addEventListener('click', () => {
      console.log('delete column');
    });
  }

  getIdentifier(): string {
    return "table.delete_column";
  }

  getTargetElements(): string[] {
    return ['th'];
  }

}