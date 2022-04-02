import { library } from "@fortawesome/fontawesome-svg-core";
import { faCircle, faFileAlt, faNewspaper } from "@fortawesome/free-regular-svg-icons";
import { dom } from '@fortawesome/fontawesome-svg-core'
import {
  faTachometerAlt,
  faExternalLinkAlt,
  faChevronLeft,
  faPlus,
  faPencilAlt,
  faTimes,
  faTrash,
  faUser,
  faCog,
  faSignOutAlt,
  faSave,
  faImage
} from "@fortawesome/free-solid-svg-icons";



library.add(
  faCircle,
  faFileAlt,
  faNewspaper,
  faTachometerAlt,
  faExternalLinkAlt,
  faChevronLeft,
  faPlus,
  faPencilAlt,
  faTimes,
  faTrash,
  faUser,
  faCog,
  faSignOutAlt,
  faSave,
  faImage
);

dom.watch() // This will kick of the initial replacement of i to svg tags and configure a MutationObserver