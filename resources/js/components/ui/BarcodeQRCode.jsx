import { useState, useRef, useEffect } from "react";
import { createPortal } from "react-dom";
import Barcode from "react-barcode";
import { QRCodeCanvas } from "qrcode.react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faBarcode, faQrcode } from "@fortawesome/free-solid-svg-icons";

export default function BarcodeQRCode({ value = "PPE-0001" }) {
    const [open, setOpen] = useState(false);
    const [tab, setTab] = useState("barcode");
    const [coords, setCoords] = useState({ top: 0, left: 0 });
    const buttonRef = useRef(null);

    const openPopover = () => {
        const rect = buttonRef.current.getBoundingClientRect();
        setCoords({
            top: rect.bottom + 8,
            left: rect.left + rect.width / 2,
        });
        setOpen(true);
    };

    // Reposition on scroll/resize while open, since fixed coords
    // are computed once at click time
    useEffect(() => {
        if (!open) return;
        const reposition = () => {
            if (!buttonRef.current) return;
            const rect = buttonRef.current.getBoundingClientRect();
            setCoords({
                top: rect.bottom + 8,
                left: rect.left + rect.width / 2,
            });
        };
        window.addEventListener("scroll", reposition, true);
        window.addEventListener("resize", reposition);
        return () => {
            window.removeEventListener("scroll", reposition, true);
            window.removeEventListener("resize", reposition);
        };
    }, [open]);

    return (
        <>
            <button
                ref={buttonRef}
                type="button"
                onClick={openPopover}
                title="View barcode / QR code"
                className="flex items-center justify-center w-8 h-8 rounded-md border border-gray-700 bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40"
            >
                <FontAwesomeIcon icon={faQrcode} className="text-sm" />
            </button>

            {open &&
                createPortal(
                    <>
                        <div
                            className="fixed inset-0 z-40"
                            onClick={() => setOpen(false)}
                        />
                        <div
                            className="fixed z-50 w-52 bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-3"
                            style={{
                                top: coords.top,
                                left: coords.left,
                                transform: "translateX(-50%)",
                            }}
                        >
                            {/* Tabs */}
                            <div className="flex gap-1 mb-3 bg-gray-900 rounded-md p-1">
                                <button
                                    type="button"
                                    onClick={() => setTab("barcode")}
                                    className={`flex-1 flex items-center justify-center gap-1.5 px-2 py-1.5 text-xs font-medium rounded transition-colors ${
                                        tab === "barcode"
                                            ? "bg-gray-700 text-white"
                                            : "text-gray-400 hover:text-white"
                                    }`}
                                >
                                    <FontAwesomeIcon icon={faBarcode} />
                                    Barcode
                                </button>
                                <button
                                    type="button"
                                    onClick={() => setTab("qr")}
                                    className={`flex-1 flex items-center justify-center gap-1.5 px-2 py-1.5 text-xs font-medium rounded transition-colors ${
                                        tab === "qr"
                                            ? "bg-gray-700 text-white"
                                            : "text-gray-400 hover:text-white"
                                    }`}
                                >
                                    <FontAwesomeIcon icon={faQrcode} />
                                    QR code
                                </button>
                            </div>

                            {/* Content */}
                            <div className="flex justify-center rounded-md border border-gray-200 bg-white p-3">
                                {tab === "barcode" ? (
                                    <Barcode
                                        value={value}
                                        format="CODE128"
                                        width={2}
                                        height={40}
                                        displayValue={true}
                                        background="#ffffff"
                                        lineColor="#000000"
                                    />
                                ) : (
                                    <QRCodeCanvas
                                        value={value}
                                        size={120}
                                        bgColor="#ffffff"
                                        fgColor="#000000"
                                        level="H"
                                    />
                                )}
                            </div>

                            <p className="text-xs text-gray-500 text-center mt-2 truncate">
                                {value}
                            </p>
                        </div>
                    </>,
                    document.body,
                )}
        </>
    );
}
