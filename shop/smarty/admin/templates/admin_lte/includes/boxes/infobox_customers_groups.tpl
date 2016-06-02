[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.3
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : infobox_customers_groups.tpl
* author     : Hanspeter Zeller <hpz@xos-shop.com>
* copyright  : Copyright (c) 2007 Hanspeter Zeller
* license    : This file is part of XOS-Shop.
*
*              XOS-Shop is free software: you can redistribute it and/or modify
*              it under the terms of the GNU General Public License as published
*              by the Free Software Foundation, either version 3 of the License,
*              or (at your option) any later version.
*
*              XOS-Shop is distributed in the hope that it will be useful,
*              but WITHOUT ANY WARRANTY; without even the implied warranty of
*              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*              GNU General Public License for more details.
*
*              You should have received a copy of the GNU General Public License
*              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>. 
********************************************************************************
*}@]
<!-- infobox_customers_groups -->
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  [@{foreach name=box_content item=info_box_content from=$info_box_contents}@]
                    [@{if $smarty.foreach.box_content.first}@]           
                    <table class="table">
                      <tr>
                        <th>[@{$info_box_heading_title}@]</th>
                      </tr>
                      <tr>
                        <td> 
                          [@{$info_box_form_tag}@]                                        
                    [@{/if}@]              
                            <div>[@{$info_box_content.text}@]</div>    
                    [@{if $smarty.foreach.box_content.last}@]
                          [@{if $info_box_form_tag}@]
                          </form>
                          [@{/if}@]                  
                        </td> 
                      </tr>                                  
                    </table>
                    [@{/if}@]
                  [@{foreachelse}@] 
                    <table class="table">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table>                                                
                  [@{/foreach}@]
                </div>
              </div>
<!-- infobox_customers_groups_eof -->