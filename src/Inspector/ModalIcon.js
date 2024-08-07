import { __ } from '@wordpress/i18n';
import { useState } from 'react';
import { Button, Modal } from '@wordpress/components';
import { FaBeer } from 'react-icons/fa';
import { AiFillAccountBook } from "react-icons/ai";

export default function ModalIcon({isOpenModal, setOpenModal}) {
  
	const openModal = () => setOpenModal( true );
	const closeModal = () => setOpenModal( false );

  return <div>
    			{ isOpenModal && (
				<Modal title={__("Select Icon", "alpha")} onRequestClose={ closeModal }>

            <div>
            <FaBeer />
            <AiFillAccountBook />
            </div>
					<Button variant="secondary" onClick={ closeModal }>
						{__("Close", "alpha")}
					</Button>
				</Modal>
			) }
  </div>;
}
