import { useState } from "react";
import BarcodeQRCode from "../components/ui/BarcodeQRCode";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
    faMagnifyingGlass,
    faChevronDown,
    faPlus,
    faBarcode,
    faQrcode,
} from "@fortawesome/free-solid-svg-icons";
import AppLayout from "../Layouts/AppLayout";
import { PageHeader } from "../components/ui/PageHeader";

const COLUMNS = [
    "Fund",
    "Account Code",
    "Property Class",
    "Property Type",
    "ICS/PAR No.",
    "ICS/PAR Date",
    "ENGAS Old Property Number",
    "Old Property Number",
    "New Property Number",
    "Description",
    "Acquisition Date",
    "Quantity",
    "Unit",
    "Estimated Life",
    "Unit Value",
    "Salvage Value",
    "Monthly Depreciable",
    "Accumulated Depreciation",
    "Net Book Value",
    "Balance Per Card",
    "On Hand Per Count",
    "Responsibility Center",
    "Accountable Officer",
    "Location",
    "Condition of PPE",
    "Remarks",
    "ARE No.",
    "Status",
    "Barcode / QR Code",
];

// Columns shown by default; the rest can be turned on from the picker
const DEFAULT_VISIBLE = new Set([
    "Fund",
    "Account Code",
    "Property Type",
    "Description",
    "Acquisition Date",
    "Unit Value",
    "Net Book Value",
    "Location",
    "Condition of PPE",
    "Status",
    "Barcode / QR Code",
]);

const ROWS = [
    {
        Fund: "General Fund",
        "Account Code": "10701010",
        "Property Class": "PPE",
        "Property Type": "Equipment",
        "ICS/PAR No.": "ICS-0001",
        "ICS/PAR Date": "2025-01-15",
        "ENGAS Old Property Number": "ENGAS-0001",
        "Old Property Number": "OLD-0001",
        "New Property Number": "NEW-0001",
        Description: "Office Computer",
        "Acquisition Date": "2025-01-15",
        Quantity: "1",
        Unit: "Unit",
        "Estimated Life": "5 years",
        "Unit Value": "₱25,000.00",
        "Salvage Value": "₱0.00",
        "Monthly Depreciable": "₱416.67",
        "Accumulated Depreciation": "₱0.00",
        "Net Book Value": "₱25,000.00",
        "Balance Per Card": "1",
        "On Hand Per Count": "1",
        "Responsibility Center": "Main Office",
        "Accountable Officer": "Juan Dela Cruz",
        Location: "Room 101",
        "Condition of PPE": "Good",
        Remarks: "-",
        "ARE No.": "ARE-0001",
        Status: "Active",
        "Barcode / QR Code": "NEW-0001",
    },
];

const CUSTOM_RENDER_COLUMNS = new Set(["Barcode / QR Code"]);

export default function PropertyPlantEquipment() {
    const [visibleColumns, setVisibleColumns] = useState(DEFAULT_VISIBLE);
    const [pickerOpen, setPickerOpen] = useState(false);
    const [search, setSearch] = useState("");

    const toggleColumn = (col) => {
        setVisibleColumns((prev) => {
            const next = new Set(prev);
            next.has(col) ? next.delete(col) : next.add(col);
            return next;
        });
    };

    const shownColumns = COLUMNS.filter((c) => visibleColumns.has(c));

    const filteredRows = ROWS.filter((row) => {
        if (!search.trim()) return true;
        const q = search.toLowerCase();
        return (
            row["Description"]?.toLowerCase().includes(q) ||
            row["Property Type"]?.toLowerCase().includes(q)
        );
    });

    const renderCell = (row, header) => {
        if (header === "Barcode / QR Code") {
            return (
                <div className="flex justify-center">
                    <BarcodeQRCode value={row[header]} size={48} />
                </div>
            );
        }
        return row[header];
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
                        {/* Search */}
                        <div className="relative flex-1 min-w-[200px] sm:max-w-xs">
                            <FontAwesomeIcon
                                icon={faMagnifyingGlass}
                                className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none text-sm"
                            />
                            <input
                                type="text"
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                                placeholder="Search by name or type..."
                                className="w-full pl-9 pr-3 py-2 text-sm rounded-lg border border-gray-700 bg-gray-800 text-white placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-colors"
                            />
                        </div>

                        <div className="flex items-center gap-2 shrink-0">
                            {/* Columns picker */}
                            <div className="relative">
                                <button
                                    type="button"
                                    onClick={() => setPickerOpen((o) => !o)}
                                    className="flex items-center justify-center gap-2 px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg border border-gray-700 hover:bg-gray-700 active:bg-gray-800 transition-colors shrink-0 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-900"
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
                                            className="fixed inset-0 z-10"
                                            onClick={() => setPickerOpen(false)}
                                        />
                                        <div className="absolute right-0 mt-2 w-64 max-h-80 overflow-y-auto bg-gray-800 border border-gray-700 rounded-lg shadow-lg z-20 p-2">
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

                            {/* Primary action */}
                            <button
                                type="button"
                                className="flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors shadow-sm shadow-blue-600/20 shrink-0 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-900"
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
                        <table className="w-max min-w-full divide-y divide-gray-700 text-center">
                            <thead className="sticky top-0 z-20 bg-gray-800">
                                <tr>
                                    {shownColumns.map((header, i) => {
                                        const isFirst = i === 0;
                                        const isLast =
                                            i === shownColumns.length - 1;
                                        return (
                                            <th
                                                key={header}
                                                className={`px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-400 whitespace-nowrap ${
                                                    isFirst
                                                        ? "sticky left-0 bg-gray-800 z-30"
                                                        : ""
                                                } ${isLast ? "sticky right-0 bg-gray-800 z-30" : ""}`}
                                            >
                                                {header}
                                            </th>
                                        );
                                    })}
                                </tr>
                            </thead>

                            <tbody className="bg-gray-700 divide-y divide-gray-600">
                                {filteredRows.length === 0 ? (
                                    <tr>
                                        <td
                                            colSpan={shownColumns.length}
                                            className="px-6 py-8 text-sm text-gray-400"
                                        >
                                            No matching records found.
                                        </td>
                                    </tr>
                                ) : (
                                    filteredRows.map((row, rowIdx) => (
                                        <tr key={rowIdx}>
                                            {shownColumns.map((header, i) => {
                                                const isFirst = i === 0;
                                                const isLast =
                                                    i ===
                                                    shownColumns.length - 1;
                                                return (
                                                    <td
                                                        key={header}
                                                        className={`px-6 py-4 text-sm whitespace-nowrap ${
                                                            header ===
                                                                "Status" ||
                                                            header ===
                                                                "Condition of PPE"
                                                                ? "text-green-400"
                                                                : "text-white"
                                                        } ${isFirst ? "sticky left-0 bg-gray-700 z-10" : ""} ${
                                                            isLast
                                                                ? "sticky right-0 bg-gray-700 z-10"
                                                                : ""
                                                        }`}
                                                    >
                                                        {renderCell(
                                                            row,
                                                            header,
                                                        )}
                                                    </td>
                                                );
                                            })}
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
