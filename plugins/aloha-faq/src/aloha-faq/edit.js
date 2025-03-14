/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

import { RichText } from '@wordpress/block-editor';
import { useState } from 'react';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	const { question, answer } = attributes;
	const [isOpen, setIsOpen] = useState(false);

	const toggleParagraph = () => {
		setIsOpen(!isOpen);
	};

	return (
		<div { ...useBlockProps() }>
			<RichText
				tagName="h4"
				className="faq-question"
				value={question || ''}
				onChange={(content) => setAttributes({ question: content })}
				placeholder={__('Enter your question...', 'aloha-faq')}
				onClick={toggleParagraph}
				keepPlaceholderOnFocus={true}
			/>
			<div className={`faq-paragraph ${isOpen ? 'open' : ''}`}>
				<RichText
					tagName="p"
					value={answer || ''}
					onChange={(content) => setAttributes({ answer: content })}
					placeholder={__('Enter your answer...', 'aloha-faq')}
					keepPlaceholderOnFocus={true}
				/>
			</div>
		</div>
	);
}
