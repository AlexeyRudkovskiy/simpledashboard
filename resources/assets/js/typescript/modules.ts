import {uploadFile} from "./upload-file";
import {fileType} from "./modules/file-type";
import Translation from "./modules/translation";


export default {
  onetime: [
    fileType,
    Translation.setup
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