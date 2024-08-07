
import { __ } from '@wordpress/i18n';

import { useBlockProps, 
    RichText,
    AlignmentToolbar,
    BlockControls ,
    ColorPalette,
    InspectorControls,
    PlainText,
    InnerBlocks,
    useInnerBlocksProps,
    List,
    __experimentalLinkControl as LinkControl,
    InspectorAdvancedControls
} from '@wordpress/block-editor';

import { useState } from '@wordpress/element';


import { Button, CheckboxControl, Modal, PanelBody, Popover, RadioControl, SelectControl, SlotFillProvider, TextControl, ToggleControl } from '@wordpress/components';

import { TabPanel } from '@wordpress/components';

import { createBlock } from '@wordpress/blocks'
import classnames from 'classnames';

import { useSelect, useDispatch, withSelect, withDispatch, AsyncModeProvider } from '@wordpress/data'
import { compose } from '@wordpress/compose'

import {
    __experimentalToggleGroupControl as ToggleGroupControl,
    __experimentalToggleGroupControlOptionIcon as ToggleGroupControlOptionIcon,
} from '@wordpress/components';
import { formatLowercase, formatUppercase } from '@wordpress/icons';

import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import ModalIcon from './ModalIcon';

function GlobalInspector({ attributes, setAttributes, data}) {
  console.log("data:", data);

  const {contents } = attributes;

  const onChangeContent = ( newContent ) => {
      setAttributes( { content: newContent } );
  };
  const onChangeTitle = ( newTitle ) => {
      setAttributes( { title: newTitle } );
  };

  const onChangeAlignment = ( newAlignment ) => {
      setAttributes( {
          alignment: newAlignment === undefined ? 'none' : newAlignment,
      } );
  };

  const onChangeBGColor = ( hexColor ) => {
      setAttributes( { bg_color: hexColor } );
  };

  const onChangeTextColor = ( hexColor ) => {
      setAttributes( { text_color: hexColor } );
  };

  const onChangeContents = ( value ) => {
  setAttributes( { contents: value } );
      console.log("New richtest Value: ", value);
};

  const onSelect = ( tabName ) => {
    console.log( 'Selecting tab', tabName );
  };

  const [ isOpenModal, setOpenModal ] = useState( false );

  return ( 
  <>
  <InspectorControls group="settings">
    <PanelBody title={ __( 'Image/Icon', 'alpha' ) } initialOpen={false} >
            <div id="alpb-controls">
           

                <ToggleControl
                        label="Enable Image/Icon"
                        checked={ attributes.enableImageIcon }
                        onChange={ val => setAttributes({ enableImageIcon:val }) }
                /> 

    <fieldset>
        <legend className="blocks-base-control__label">
            { __( 'Image', 'alpha' ) }
        </legend>
        <MediaUploadCheck>
			<MediaUpload
				onSelect={ ( media ) =>
                    {
                    setAttributes({mediaImageId:media.id});
					console.log( 'selected :', media )
                    }
				}
				allowedTypes={ ['audio', 'image'] }
				value={ attributes.mediaImageId }
				render={ ( { open } ) => (
					<Button onClick={ open }>Open Media Library</Button>
				) }
                mode="browse"
			/>
		</MediaUploadCheck>
    </fieldset>

    <fieldset>
        <legend className="blocks-base-control__label">
            { __( 'Icon', 'alpha' ) }
        </legend>
        <div>
            <Button onClick={()=>setOpenModal(true)}>Chose Icon</Button>
           <ModalIcon isOpenModal={isOpenModal} setOpenModal={setOpenModal}></ModalIcon>
		</div>
    </fieldset>
            </div>
        </PanelBody>
    </InspectorControls>

  <InspectorControls group="settings">
    <PanelBody title={ __( 'Settings' ) } initialOpen={false} >
        <div id="gutenpride-controls">
            <fieldset>
                <legend className="blocks-base-control__label">
                    { __( 'Background color', 'gutenpride' ) }
                </legend>
                <ColorPalette 
                    value={ attributes.bg_color }
                    onChange={ onChangeBGColor }
                />
            </fieldset>
            <fieldset>
                <legend className="blocks-base-control__label">
                    { __( 'Text color', 'gutenpride' ) }
                </legend>
                <ColorPalette 
                    value={ attributes.text_color }
                    onChange={ onChangeTextColor }
                />
            </fieldset>
        </div>
    </PanelBody>
</InspectorControls>

<InspectorControls group="styles">
        <PanelBody title={ __( 'Links Settings', 'alpha' ) } initialOpen={false} >
            <div id="alpb-controls">
                <fieldset>
                    <legend className="blocks-base-control__label">
                        { __( 'Background color', 'alpha' ) }
                    </legend>
                    <ColorPalette 
                        value={ attributes.bg_color }
                        onChange={ onChangeBGColor }
                    />
                </fieldset>
                <fieldset>
                    <legend className="blocks-base-control__label">
                        { __( 'Text color', 'alpha' ) }
                    </legend>
                    <ColorPalette 
                          value={ attributes.text_color }
                        onChange={ onChangeTextColor }
                    />
                </fieldset>
            </div>
        </PanelBody>
    </InspectorControls>

</>
);
}

export default GlobalInspector;
