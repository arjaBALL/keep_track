import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

import {
    faGaugeHigh,
    faTicket,
    faBell,
    faUserPlus,
    faKey,
    faCompass,
    faCar,
    faShip,
    faDatabase,
    faUserTag,
    faMoneyBill,
    faBarcode,
    faTags,
    faShapes,
    faBuilding,
    faCircleCheck,
    faLocationDot,
    faBoxesStacked,
} from "@fortawesome/free-solid-svg-icons";

export default function NavIcon({ name }) {
    const icons = {
        dashboard: faGaugeHigh,
        ticket: faTicket,
        bell: faBell,
        userPlus: faUserPlus,
        userkey: faKey,
        compass: faCompass,
        carFront: faCar,
        ship: faShip,
        database: faDatabase,
        usertag: faUserTag,
        moneybill: faMoneyBill,
        barcode: faBarcode,
        tags: faTags,
        shapes: faShapes,
        responsibilityCenter: faBuilding,
        status: faCircleCheck,
        location: faLocationDot,
        boxstacked: faBoxesStacked,
    };

    return icons[name] ? <FontAwesomeIcon icon={icons[name]} size="" /> : null;
}
