import {uploadFile} from "./upload-file";
import {fileType} from "./modules/file-type";
import Translation from "./modules/translation";
import {toggleBoolean} from "./modules/toggle-boolean";


export default {
  onetime: [
    fileType,
    toggleBoolean,
    Translation.setup,
  ],
  async: {
    any: [
      Translation.translateAutomatically
    ],
    files: [
      uploadFile
    ]
  }
};