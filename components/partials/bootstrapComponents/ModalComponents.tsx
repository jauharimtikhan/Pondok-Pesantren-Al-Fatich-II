"use client";
import { Modal, Button } from "react-bootstrap";
interface ModalComponentsProps {
  show: any;
  handleClose: any;
}

const ModalComponents: React.FC<ModalComponentsProps> = ({
  show,
  handleClose,
}) => {
  return (
    <Modal show={show} onHide={handleClose}>
      <Modal.Header closeButton>
        <Modal.Title>Contoh Modal</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        Ini adalah contoh modal Bootstrap 4 dalam aplikasi Next.js.
      </Modal.Body>
      <Modal.Footer>
        <Button variant="secondary" onClick={handleClose}>
          Tutup
        </Button>
        <Button variant="primary" onClick={handleClose}>
          Simpan Perubahan
        </Button>
      </Modal.Footer>
    </Modal>
  );
};

export default ModalComponents;
