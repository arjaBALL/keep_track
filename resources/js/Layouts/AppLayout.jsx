import Sidebar from "./Sidebar";
import NavBar from "./NavBar";

export default function AppLayout({ children }) {
    return (
        <div className="flex h-screen overflow-hidden">
            <Sidebar />

            <div className="flex flex-col flex-1 min-w-0">
                {/* <NavBar /> */}

                <main className="flex-1 min-w-0 overflow-auto p-0 bg-gray-900 text-white">
                    {children}
                </main>
            </div>
        </div>
    );
}
