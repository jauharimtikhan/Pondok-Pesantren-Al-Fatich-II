import Image from "next/image";
import React from "react";

interface TestimonoalProps {
  name: string;
  description: string;
}

const TestimonialComponents: React.FC<TestimonoalProps> = ({
  name,
  description,
}) => {
  return (
    <div className="testimonial-block style-2 gray-bg">
      <i className="icofont-quote-right text-dark"></i>

      <div className="testimonial-thumb">
        <Image
          src="/images/user-testi.png"
          alt="User Testimoni"
          width={50}
          height={50}
        />
      </div>

      <div className="client-info">
        <h4 className="mt-3">{name}</h4>
        <p className="text-dot-2">{description}</p>
      </div>
    </div>
  );
};

export default TestimonialComponents;
