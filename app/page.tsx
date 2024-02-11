"use client";
import AboutSection from "@/components/HomeComponent/AboutSection";
import AppointmentSection from "@/components/HomeComponent/AppointmentSection";
import BannerSection from "@/components/HomeComponent/BannerSection";
import ClientSection from "@/components/HomeComponent/ClientSection";
import CtaSection from "@/components/HomeComponent/CtaSection";
import FeaturesSection from "@/components/HomeComponent/FeaturesSection";
import ServiceSection from "@/components/HomeComponent/ServiceSection";
import TestimonialSection from "@/components/HomeComponent/TestimonialSection";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import AOS from "aos";
import "aos/dist/aos.css";
import { useEffect } from "react";
export default function Home() {
  useEffect(() => {
    AOS.init();
  }, []);
  return (
    <>
      <Navigation />

      <BannerSection />

      <FeaturesSection />

      <AboutSection />

      <CtaSection />

      <ServiceSection />

      <AppointmentSection />

      <TestimonialSection />

      <ClientSection />

      <Footer />
    </>
  );
}
