import { useState, useRef } from "react";
import BarcodeQRCode from "../components/ui/BarcodeQRCode";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
    faMagnifyingGlass,
    faChevronDown,
    faPlus,
} from "@fortawesome/free-solid-svg-icons";
import AppLayout from "../Layouts/AppLayout";
import { PageHeader } from "../components/ui/PageHeader";
import { router } from "@inertiajs/react";

const COLUMN_FIELDS = {
    "ICS/PAR No.": "identification.ics_par_no",
    "ICS/PAR Date": "identification.ics_par_date",
    "ENGAS Old Property Number": "identification.engas_old_property_no",
    "Old Property Number": "identification.old_property_no",
    "New Property Number": "identification.new_property_no",
    Description: "description.description",
    "Acquisition Date": "description.acquisition_date",
    Quantity: "description.quantity",
    Unit: "description.unit",
    "Estimated Life": "valuation.estimated_life",
    "Unit Value": "valuation.unit_value",
    "Salvage Value": "valuation.salvage_value",
    "Monthly Depreciable": "valuation.monthly_depreciation",
    "Accumulated Depreciation": "valuation.accumulated_depreciation",
    "Net Book Value": "valuation.net_book_value",
    "Balance Per Card": "accountability.balance_per_card",
    "On Hand Per Count": "accountability.on_hand_per_count",
    "Condition of PPE": "location.condition_of_ppe",
    Remarks: "location.remarks",
    Status: "status.status.status",
    "ARE No.": "status.are_on",
    "Barcode / QR Code": "identification.new_property_no",
    Fund: "classification.fund.fund_name",
    "Account Code": "classification.account.code",
    "Property Class": "classification.property_class.property_class_name",
    "Property Type": "classification.property_type.property_type_name",
    "Responsibility Center":
        "accountability.responsibility_center.responsibility_center_name",
    "Accountable Officer": "accountability.accountable_officer.name",
    Location: "location.location.location_name",
};

const COLUMNS = Object.keys(COLUMN_FIELDS);

const STICKY_LEFT_ORDER = [
    "Fund",
    "Account Code",
    "Property Class",
    "Property Type",
];
const STICKY_LEFT_HEADERS = new Set(STICKY_LEFT_ORDER);

const STICKY_RIGHT = ["Barcode / QR Code"];
const STICKY_RIGHT_HEADERS = new Set(STICKY_RIGHT);

const DEFAULT_VISIBLE = new Set([
    "Fund",
    "Account Code",
    "Property Class",
    "Property Type",
    "Description",
    "Acquisition Date",
    "Unit Value",
    "Net Book Value",
    "Condition of PPE",
    "Status",
    "Barcode / QR Code",
]);

const SHORT_VALUE_HEADERS = new Set([
    "Accumulated Depreciation",
    "Acquisition Date",
    "ARE No.",
    "Balance Per Card",
    "ENGAS Old Property Number",
    "Estimated Life",
    "ICS/PAR Date",
    "ICS/PAR No.",
    "Monthly Depreciable",
    "Net Book Value",
    "New Property Number",
    "Old Property Number",
    "On Hand Per Count",
    "Quantity",
    "Salvage Value",
    "Status",
    "Unit",
    "Unit Value",
]);

function getByPath(obj, path) {
    return path
        .split(".")
        .reduce((acc, key) => (acc == null ? acc : acc[key]), obj);
}

function formatDate(value) {
    if (!value) return "-";
    const d = new Date(value);
    return isNaN(d) ? value : d.toLocaleDateString();
}

function formatCurrency(value) {
    if (value === null || value === undefined || value === "") return "-";
    const n = Number(value);
    if (isNaN(n)) return value;
    return `₱${n.toLocaleString(undefined, { minimumFractionDigits: 2 })}`;
}

const DATE_FIELDS = new Set([
    "identification.ics_par_date",
    "description.acquisition_date",
]);
const CURRENCY_FIELDS = new Set([
    "valuation.unit_value",
    "valuation.salvage_value",
    "valuation.monthly_depreciation",
    "valuation.accumulated_depreciation",
    "valuation.net_book_value",
]);

const BARCODE_VALUE_FIELDS = [
    "classification.fund.fund_name",
    "classification.account.code",
    "classification.property_class.property_class_name",
    "description.description",
    "description.acquisition_date",
];
const BARCODE_VALUE_DELIMITER = " | ";

function buildBarcodeValue(row) {
    const parts = BARCODE_VALUE_FIELDS.map((path) => {
        let v = getByPath(row, path);
        if (DATE_FIELDS.has(path)) v = formatDate(v);
        if (v && typeof v === "object") v = v.name ?? v.label ?? "-";
        return v ?? "-";
    });
    return parts.join(BARCODE_VALUE_DELIMITER);
}

export default function PropertyPlantEquipment({ items = { data: [] } }) {
    const [visibleColumns, setVisibleColumns] = useState(DEFAULT_VISIBLE);
    const [pickerOpen, setPickerOpen] = useState(false);
    const [search, setSearch] = useState("");
    const searchTimeout = useRef(null);

    const toggleColumn = (col) => {
        setVisibleColumns((prev) => {
            const next = new Set(prev);
            next.has(col) ? next.delete(col) : next.add(col);
            return next;
        });
    };
    const visibleLeft = STICKY_LEFT_ORDER.filter((h) => visibleColumns.has(h));
    const visibleRight = STICKY_RIGHT.filter((h) => visibleColumns.has(h));
    const visibleMiddle = COLUMNS.filter(
        (c) =>
            visibleColumns.has(c) &&
            !STICKY_LEFT_HEADERS.has(c) &&
            !STICKY_RIGHT_HEADERS.has(c),
    );

    const shownColumns = [...visibleLeft, ...visibleMiddle, ...visibleRight];

    const DEFAULT_COLUMN_WIDTH = 190;
    const COLUMN_WIDTHS = {
        Fund: 220,
        "Account Code": 130,
        "Property Class": 160,
        "Property Type": 160,
        "Barcode / QR Code": 120,
        Description: 280,
        Remarks: 240,
        Location: 220,
        "Accountable Officer": 200,
        "Responsibility Center": 220,
        "ENGAS Old Property Number": 220,
        "Old Property Number": 180,
        "New Property Number": 180,
        "ICS/PAR No.": 140,
        "ICS/PAR Date": 130,
        "Acquisition Date": 130,
        Quantity: 100,
        Unit: 90,
        "Estimated Life": 120,
        "Unit Value": 130,
        "Salvage Value": 130,
        "Monthly Depreciable": 150,
        "Accumulated Depreciation": 170,
        "Net Book Value": 150,
        "Balance Per Card": 150,
        "On Hand Per Count": 150,
        "Condition of PPE": 150,
        Status: 120,
        "ARE No.": 120,
    };

    function getColumnWidth(header) {
        return COLUMN_WIDTHS[header] ?? DEFAULT_COLUMN_WIDTH;
    }
    const leftOffsets = {};
    let runningLeft = 0;
    visibleLeft.forEach((header) => {
        leftOffsets[header] = runningLeft;
        runningLeft += getColumnWidth(header);
    });

    const getStickyStyle = (header) => {
        const width = getColumnWidth(header);

        if (
            STICKY_LEFT_HEADERS.has(header) &&
            leftOffsets[header] !== undefined
        ) {
            return {
                position: "sticky",
                left: leftOffsets[header],
                zIndex: 10,
                width,
                minWidth: width,
                maxWidth: width,
            };
        }
        if (STICKY_RIGHT_HEADERS.has(header)) {
            return {
                position: "sticky",
                right: 0,
                zIndex: 10,
                width,
                minWidth: width,
                maxWidth: width,
            };
        }
        return undefined;
    };

    const getCellStyle = (header) => {
        const stickyStyle = getStickyStyle(header);
        if (stickyStyle) return stickyStyle;
        const width = getColumnWidth(header);
        return { width, minWidth: width, maxWidth: width };
    };

    const getWrapClasses = (header) => {
        const isSticky =
            STICKY_LEFT_HEADERS.has(header) || STICKY_RIGHT_HEADERS.has(header);
        const isShortValue = SHORT_VALUE_HEADERS.has(header);

        if (isSticky || isShortValue) {
            return "whitespace-nowrap overflow-hidden text-ellipsis";
        }
        return "whitespace-normal break-words";
    };
    const getHeaderWrapClasses = () =>
        "whitespace-normal break-words leading-tight";

    const isLastStickyLeft = (header) =>
        visibleLeft.length > 0 &&
        visibleLeft[visibleLeft.length - 1] === header;
    const isFirstStickyRight = (header) =>
        visibleRight.length > 0 && visibleRight[0] === header;

    const handleSearch = (query) => {
        setSearch(query);

        clearTimeout(searchTimeout.current);

        searchTimeout.current = setTimeout(() => {
            router.get(
                "/request-trip-ticket",
                { search: query },
                {
                    preserveState: true,
                    preserveScroll: true,
                    replace: true,
                },
            );
        }, 500);
    };

    const renderCell = (row, header) => {
        const path = COLUMN_FIELDS[header];

        if (header === "Barcode / QR Code") {
            const shortLabel =
                getByPath(row, "identification.new_property_no") ?? "-";
            return (
                <div className="flex justify-center">
                    <BarcodeQRCode
                        value={buildBarcodeValue(row)}
                        label={shortLabel}
                        size={38}
                    />
                </div>
            );
        }

        let value = getByPath(row, path);

        if (value && typeof value === "object") {
            value = value.name ?? value.label ?? "-";
        }

        if (DATE_FIELDS.has(path)) value = formatDate(value);
        else if (CURRENCY_FIELDS.has(path)) value = formatCurrency(value);

        const display = value ?? "-";
        return (
            <span title={typeof display === "string" ? display : undefined}>
                {display}
            </span>
        );
    };

    return (
        <AppLayout>
            <div className="p-4 sm:p-6 w-full min-w-0">
                <div className="flex flex-col gap-3 mb-4">
                    <PageHeader
                        title="Inventory"
                        description="Long-term tangible assets used in business operations, such as land, buildings, machinery, and equipment."
                    />

                    <div className="flex flex-col-reverse sm:flex-row items-stretch sm:items-center gap-2 sm:gap-3 flex-wrap">
                        <div className="relative flex-1 min-w-[200px] sm:max-w-xs">
                            <FontAwesomeIcon
                                icon={faMagnifyingGlass}
                                className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none text-sm"
                            />
                            <input
                                type="text"
                                value={search}
                                onChange={(e) => handleSearch(e.target.value)}
                                placeholder="Search by description..."
                                className="w-full pl-9 pr-3 py-2 text-sm rounded-lg border border-gray-700 bg-gray-800 text-white placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-colors"
                            />
                        </div>

                        <div className="flex items-center gap-2 shrink-0">
                            <div className="relative">
                                <button
                                    type="button"
                                    onClick={() => setPickerOpen((o) => !o)}
                                    className="flex items-center justify-center gap-2 px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg border border-gray-700 hover:bg-gray-700 transition-colors shrink-0"
                                >
                                    <span>
                                        Columns
                                        <span className="text-gray-400 ml-1">
                                            {shownColumns.length}/
                                            {COLUMNS.length}
                                        </span>
                                    </span>
                                    <FontAwesomeIcon
                                        icon={faChevronDown}
                                        className={`text-xs text-gray-400 transition-transform ${
                                            pickerOpen ? "rotate-180" : ""
                                        }`}
                                    />
                                </button>

                                {pickerOpen && (
                                    <>
                                        <div
                                            className="fixed inset-0 z-40"
                                            onClick={() => setPickerOpen(false)}
                                        />
                                        <div className="absolute right-0 mt-2 w-64 max-h-80 overflow-y-auto bg-gray-800 border border-gray-700 rounded-lg shadow-lg z-50 p-2">
                                            {COLUMNS.map((col) => (
                                                <label
                                                    key={col}
                                                    className="flex items-center gap-2 px-2 py-1.5 text-sm text-white rounded hover:bg-gray-700 cursor-pointer"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        checked={visibleColumns.has(
                                                            col,
                                                        )}
                                                        onChange={() =>
                                                            toggleColumn(col)
                                                        }
                                                        className="rounded accent-blue-600"
                                                    />
                                                    {col}
                                                </label>
                                            ))}
                                        </div>
                                    </>
                                )}
                            </div>

                            <button
                                type="button"
                                className="flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm shadow-blue-600/20 shrink-0"
                            >
                                <FontAwesomeIcon
                                    icon={faPlus}
                                    className="text-xs"
                                />
                                <span>New</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div className="rounded-lg border border-gray-700 overflow-hidden w-full min-w-0">
                    <div className="table-scroll overflow-auto w-full max-h-[70vh]">
                        <table className="table-fixed min-w-full divide-y divide-gray-700 text-center">
                            <thead className="sticky top-0 z-30 bg-gray-800">
                                <tr>
                                    {shownColumns.map((header) => {
                                        const stickyStyle =
                                            getStickyStyle(header);
                                        const cellStyle = getCellStyle(header);
                                        const edgeShadow = isLastStickyLeft(
                                            header,
                                        )
                                            ? "shadow-[4px_0_6px_-2px_rgba(0,0,0,0.4)]"
                                            : isFirstStickyRight(header)
                                              ? "shadow-[-4px_0_6px_-2px_rgba(0,0,0,0.4)]"
                                              : "";
                                        return (
                                            <th
                                                key={header}
                                                style={cellStyle}
                                                title={header}
                                                className={`px-6 py-3 text-xs font-medium uppercase tracking-wider text-gray-400 align-middle ${getHeaderWrapClasses()} ${
                                                    stickyStyle
                                                        ? "bg-gray-800 z-40"
                                                        : ""
                                                } ${edgeShadow}`}
                                            >
                                                {header}
                                            </th>
                                        );
                                    })}
                                </tr>
                            </thead>

                            <tbody className="bg-gray-700 divide-y divide-gray-600">
                                {items.data?.length > 0 ? (
                                    items.data.map((item) => (
                                        <tr key={item.id}>
                                            {shownColumns.map((header) => {
                                                const stickyStyle =
                                                    getStickyStyle(header);
                                                const cellStyle =
                                                    getCellStyle(header);
                                                const edgeShadow =
                                                    isLastStickyLeft(header)
                                                        ? "shadow-[4px_0_6px_-2px_rgba(0,0,0,0.4)]"
                                                        : isFirstStickyRight(
                                                                header,
                                                            )
                                                          ? "shadow-[-4px_0_6px_-2px_rgba(0,0,0,0.4)]"
                                                          : "";
                                                return (
                                                    <td
                                                        key={header}
                                                        style={cellStyle}
                                                        className={`px-6 py-4 text-sm text-gray-200 align-top ${getWrapClasses(
                                                            header,
                                                        )} ${
                                                            stickyStyle
                                                                ? "bg-gray-700"
                                                                : ""
                                                        } ${edgeShadow}`}
                                                    >
                                                        {renderCell(
                                                            item,
                                                            header,
                                                        )}
                                                    </td>
                                                );
                                            })}
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td
                                            colSpan={shownColumns.length}
                                            className="px-5 py-12 text-center"
                                        >
                                            <p className="text-sm font-medium text-slate-300">
                                                No inventory items found
                                            </p>
                                            <p className="text-xs text-slate-500 mt-1">
                                                Try a different search, or add a
                                                new inventory item.
                                            </p>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                    {items.links && items.links.length > 3 && (
                        <div className="flex items-center justify-between px-5 py-4 border-t border-gray-700">
                            <div className="text-sm text-gray-400">
                                Showing{" "}
                                <span className="font-medium text-gray-200">
                                    {items.meta?.from ?? 0}
                                </span>{" "}
                                to{" "}
                                <span className="font-medium text-gray-200">
                                    {items.meta?.to ?? 0}
                                </span>{" "}
                                of{" "}
                                <span className="font-medium text-gray-200">
                                    {items.meta?.total ?? 0}
                                </span>{" "}
                                results
                            </div>
                            <div className="flex items-center gap-1">
                                {items.meta?.links?.map((link, index) => {
                                    if (!link.url) {
                                        return (
                                            <span
                                                key={index}
                                                className="px-3 py-1.5 text-sm text-gray-600"
                                                dangerouslySetInnerHTML={{
                                                    __html: link.label,
                                                }}
                                            />
                                        );
                                    }
                                    return (
                                        <button
                                            key={index}
                                            type="button"
                                            onClick={() =>
                                                router.get(
                                                    link.url,
                                                    {},
                                                    {
                                                        preserveState: true,
                                                        preserveScroll: true,
                                                    },
                                                )
                                            }
                                            className={`px-3 py-1.5 text-sm rounded-md transition-colors ${
                                                link.active
                                                    ? "bg-blue-600 text-white"
                                                    : "text-gray-400 hover:bg-gray-700"
                                            }`}
                                            dangerouslySetInnerHTML={{
                                                __html: link.label,
                                            }}
                                        />
                                    );
                                })}
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
