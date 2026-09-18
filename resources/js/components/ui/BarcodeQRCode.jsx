import { useRef } from "react";
import Barcode from "react-barcode";
import { QRCodeCanvas } from "qrcode.react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faQrcode } from "@fortawesome/free-solid-svg-icons";

export default function BarcodeQRCode({ value = "PPE-0001", label }) {
    // `value` is what actually gets encoded in the QR code / barcode (the
    // full data read back when scanned). `label` is the short text printed
    // underneath the barcode for humans — defaults to `value` if not given.
    const displayLabel = label ?? value;

    const printRef = useRef(null); // wraps the printable label content (hidden, never shown)

    const handlePrint = () => {
        if (!printRef.current) return;

        // Clone the label markup so we don't touch the live (hidden) source
        const clone = printRef.current.cloneNode(true);

        // Canvas elements (QRCodeCanvas) don't carry pixel data when
        // cloned, so swap each one for a static image of its contents.
        const liveCanvases = printRef.current.querySelectorAll("canvas");
        const clonedCanvases = clone.querySelectorAll("canvas");
        liveCanvases.forEach((canvas, i) => {
            const img = document.createElement("img");
            img.src = canvas.toDataURL("image/png");
            img.style.width = `${canvas.width}px`;
            img.style.height = `${canvas.height}px`;
            clonedCanvases[i]?.replaceWith(img);
        });

        const iframe = document.createElement("iframe");
        iframe.style.position = "fixed";
        iframe.style.right = "0";
        iframe.style.bottom = "0";
        iframe.style.width = "0";
        iframe.style.height = "0";
        iframe.style.border = "0";
        document.body.appendChild(iframe);

        const doc = iframe.contentWindow.document;
        doc.open();
        doc.write(`
            <html>
                <head>
                    <title>Print Label</title>
                    <style>
                        @page { size: auto; margin: 3mm; }
                        * { box-sizing: border-box; }
                        body {
                            margin: 0;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            font-family: Arial, Helvetica, sans-serif;
                            background: #ffffff;
                        }

                        /* Outer bordered label card, matches the physical sticker */
                        .print-label {
                            display: flex;
                            flex-direction: column;
                            width: 250px;
                            border: 1.5px solid #000;
                            padding: 6px 8px;
                            background: #ffffff;
                        }

                        /* Top row: QR on the left, text + logo on the right */
                        .print-label__top {
                            display: flex;
                            align-items: flex-start;
                            gap: 6px;
                        }
                        .print-label__qr {
                            flex: 0 0 auto;
                            display: flex;
                        }
                        .print-label__qr img,
                        .print-label__qr canvas {
                            width: 62px;
                            height: 62px;
                            display: block;
                            margin-bottom:6px;
                        }
                        .print-label__info {
                            flex: 1 1 auto;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: flex-start;
                            text-align: center;
                            min-width: 0;
                        }
                        .print-label__info-text {
                            font-size: 9px;
                            font-weight: 700;
                            line-height: 1.15;
                            letter-spacing: 0.2px;
                            text-transform: uppercase;
                            margin-bottom: 3px;
                        }
                        .print-label__logo img {
                            height: 80px;
                            width: auto;
                            object-fit: contain;
                            display: block;
                        }

                        /* Barcode spans full width beneath */
                        .print-label__barcode {
                            width: 100%;
                            display: flex;
                            justify-content: center;
                            margin-top: 4px;
                        }
                        .print-label__barcode svg,
                        .print-label__barcode img {
                            max-width: 100%;
                            height: auto;
                        }
                    </style>
                </head>
                <body>
                    <div class="print-label">
                        <div class="print-label__top">
                            <div class="print-label__qr">${
                                clone.querySelector('[data-part="qr"]')
                                    ?.innerHTML ?? ""
                            }</div>
                            <div class="print-label__info">
                                <div class="print-label__info-text">${
                                    clone.querySelector(
                                        '[data-part="info-text"]',
                                    )?.innerHTML ?? ""
                                }</div>
                                <div class="print-label__logo">${
                                    clone.querySelector('[data-part="logo"]')
                                        ?.innerHTML ?? ""
                                }</div>
                            </div>
                        </div>
                        <div class="print-label__barcode">${
                            clone.querySelector('[data-part="barcode"]')
                                ?.innerHTML ?? ""
                        }</div>
                    </div>
                </body>
            </html>
        `);
        doc.close();

        iframe.onload = () => {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
            setTimeout(() => document.body.removeChild(iframe), 1000);
        };
    };

    return (
        <>
            <button
                type="button"
                onClick={handlePrint}
                title="Print barcode / QR code label"
                className="flex items-center justify-center w-8 h-8 rounded-md border border-gray-700 bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40"
            >
                <FontAwesomeIcon icon={faQrcode} className="text-sm" />
            </button>
            <div
                ref={printRef}
                aria-hidden="true"
                className="grid grid-cols-2 md:grid-cols-2 border-slate-200 bg-white p-2 shadow-sm dark:border-slate-700 dark:bg-slate-900"
                style={{
                    position: "absolute",
                    top: 0,
                    left: 0,
                    width: 0,
                    height: 0,
                    overflow: "hidden",
                    opacity: 0,
                    pointerEvents: "none",
                }}
            >
                <div data-part="qr" className="flex min-h-[60px] flex-col">
                    <QRCodeCanvas
                        value={value}
                        size={120}
                        bgColor="#ffffff"
                        fgColor="#000000"
                        level="H"
                    />
                </div>

                <div className="flex flex-col items-center justify-center">
                    <span
                        data-part="info-text"
                        className="text-center text-[8px] font-semibold leading-tight text-slate-900 dark:text-white mb-2"
                    >
                        BUREAU OF FISHERIES AND AQUATIC RESOURCES REGIONAL
                        OFFICE VIII
                    </span>
                    <div data-part="logo">
                        <img
                            src="/img/dabfar.jpg"
                            alt="BFAR"
                            className="mb-2 h-12 w-auto object-contain"
                        />
                    </div>
                </div>

                <div
                    data-part="barcode"
                    className="col-span-2 flex flex-col items-center overflow-hidden"
                >
                    <div className="col-span-2 flex items-center justify-center overflow-hidden">
                        <Barcode
                            value={value}
                            text={displayLabel}
                            format="CODE128"
                            fontSize={16}
                            width={1}
                            height={120}
                            displayValue={true}
                            background="#ffffff"
                            lineColor="#000000"
                            renderer="svg"
                            margin={0}
                            textMargin={0}
                            style={{
                                width: "auto",
                                maxWidth: "220px",
                                height: "auto",
                                display: "block",
                                margin: 0,
                                padding: 0,
                            }}
                        />
                    </div>
                </div>
            </div>
        </>
    );
}
