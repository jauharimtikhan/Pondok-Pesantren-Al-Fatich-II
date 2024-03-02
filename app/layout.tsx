import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";
import "../public/plugins/bootstrap/css/bootstrap.min.css";
import "../public/plugins/icofont/icofont.min.css";
import "../public/plugins/slick-carousel/slick/slick.css";
import "../public/plugins/slick-carousel/slick/slick-theme.css";
import Script from "next/script";
const inter = Inter({ subsets: ["latin"] });
import NextTopLoader from "nextjs-toploader";
export const metadata: Metadata = {
  title: "Pondok Pesantren Al Fatich 2",
  description:
    "Dibuat sepenuh hati dan cinta oleh tim Mahasiswa UNWAHA Jombang",
  authors: {
    name: "PP. Al Fatich 2",
  },
  icons: {
    icon: [
      {
        url: "/favicon/favicon.ico",
        sizes: "any",
        type: "image/x-icon",
      },
    ],
  },
};
export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body className={inter.className} id="top">
        <NextTopLoader
          color="#1c9197"
          initialPosition={0.08}
          crawlSpeed={200}
          height={3}
          crawl={true}
          showSpinner={false}
          easing="ease"
          speed={300}
          shadow="0 0 10px #1c9197,0 0 5px #1c9197"
          template='<div class="bar" role="bar"><div class="peg"></div></div> 
  <div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'
          zIndex={1600}
          showAtBottom={false}
        />
        <Script src="/plugins/jquery/jquery.js"></Script>
        <Script src="/plugins/bootstrap/js/bootstrap.min.js"></Script>
        <Script src="/plugins/bootstrap/js/popper.js"></Script>
        <Script src="/plugins/counterup/jquery.easing.js"></Script>
        <Script src="/plugins/slick-carousel/slick/slick.min.js"></Script>
        <Script src="/plugins/counterup/jquery.waypoints.min.js"></Script>
        {/* <Script src="/plugins/shuffle/shuffle.min.js"></Script> */}
        {/* <Script src="/plugins/counterup/jquery.counterup.min.js"></Script> */}
        <Script src="/plugins/google-map/map.js"></Script>
        <Script src="./js/script.js"></Script>
        {children}
      </body>
    </html>
  );
}
